<?php

namespace App\Http\Controllers;

use App\Models\Application;
use HackerESQ\Settings\Facades\Settings;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use MyFatoorah\Library\PaymentMyfatoorahApiV2;

class PaymentController
{
    public static function pay(Application $application){
        $callback = route('callBack' , $application->uuid);
        return self::{self::findMethod($application->gateway)}($application , $callback);
    }
    public static function callBack(Request $request, Application $application = null){

        $method = self::findMethod($application->gateway) . 'Callback';
        list($status , $msg ,$invoiceId , $invoiceReference , $application) =  self::{$method}($request , $application);
        if ( $application == null)
            abort(404);

        if ( $status ){
            return self::applicationPaid($application , $invoiceId , $invoiceReference );
        }
        return redirect()->route('application.show' , ['uuid' => $application->uuid , 'msg' => $msg ]);

    }

    public static function applicationPaid(Application $application , $invoiceId = null , $invoiceReference = null , $isFree = false ){
        if ( $isFree ) {
            $application->gateway = 'local';
        }
        if ( $invoiceId )
            $application->invoiceId = $invoiceId;

        if ( $invoiceId )
            $application->invoiceReference = $invoiceReference;

        $application->paid = true;
        $application->paid_at = now();
        $application->save();
//            dispatch(new sendRegisterEmailJob($application->id));
        return redirect()->route('application.show' , ['uuid' => $application->uuid ]);
    }

    public static function myfatourah(Application $application , $callback)
    {
        $payLoadData = [
            'CustomerName'       => $application->name,
            'InvoiceValue'       => $application->package->price,
            'DisplayCurrencyIso' => 'KWD',
//                'CustomerEmail'      => $this->form['FEmail'],
            'CallBackUrl'        => $callback,
            'ErrorUrl'           => $callback,
            'MobileCountryCode'  => '+965',
//                'CustomerMobile'     => $this->form['FMobile'],
            'Language'           => 'en',
            'CustomerReference'  => $application->id,
            'SourceInfo'         => $application->package->title,
        ];
        $mfObj = new PaymentMyfatoorahApiV2(Settings::get('MYFATOORAH_IS_LIVE', true) ? Settings::get('MYFATOORAH_API_KEY') : config('myfatoorah.api_key') , config('myfatoorah.country_iso'), ! (bool) Settings::get('MYFATOORAH_IS_LIVE', true));
        $data = $mfObj->getInvoiceURL($payLoadData, 0);
        $application->price = $application->package->price;
        $application->gateway = 'myfatourah';
        $application->invoiceId = $data['invoiceId'];
        $application->save();
        return redirect()->to($data['invoiceURL']);
    }
    public static function myfatourahCallback(Request $request,Application $application = null)
    {
        $status = false;
        $invoiceReference = null;
        $application = null;
        try {
            $mfObj = new PaymentMyfatoorahApiV2(Settings::get('MYFATOORAH_IS_LIVE', true) ? Settings::get('MYFATOORAH_API_KEY') : config('myfatoorah.api_key') , config('myfatoorah.country_iso'), ! (bool) Settings::get('MYFATOORAH_IS_LIVE', true));
            $data = $mfObj->getPaymentStatus(request('paymentId'), 'PaymentId');

            if (intval($data->CustomerReference) > 0)
                $application = Application::query()->where('paid' , 0)->findOrFail($data->CustomerReference);
            if ($data->InvoiceReference)
                $invoiceReference = $data->InvoiceReference;
            if ($data->InvoiceStatus == 'Paid') {
                $msg = 'Invoice is paid.';
                $status = true;
            } else if ($data->InvoiceStatus == 'Failed') {
                $msg = 'Invoice is not paid due to ' . $data->InvoiceError;
            } else if ($data->InvoiceStatus == 'Expired') {
                $msg = 'Invoice is expired.';
            }

        } catch (\Exception $e) {
            $status = false;
            $msg = $e->getMessage();
        }
        if ( $application == null)
            abort(404);

        return array($status , $msg , null , $invoiceReference , $application);
    }

    private static function findMethod($gateway)
    {
        switch ( $gateway ){
            case 'myfatourah':
                $method = 'myfatourah';
                break;
            default :
                $method = 'knet';
                break;
        }
        return $method;
    }
}
