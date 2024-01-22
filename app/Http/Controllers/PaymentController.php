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


    public static function knet(Application $application ,string $callback)
    {
        $PAYMENT_REQUEST_URL = Settings::get('KNET_IS_LIVE', true) ? 'https://www.kpay.com.kw' : 'https://www.kpaytest.com.kw'  ;
        $PAYMENT_REQUEST_URL .= '/kpg/PaymentHTTP.htm?param=paymentInit&trandata=';
        $key = config('app.key');
        if (str_starts_with($key, 'base64:')) {
            $key = base64_decode(substr($key, 7));
        }
        $TERM_RESOURCE_KEY = hash('sha256', $key);

        $param = 'id=' . Settings::get('KNET_TRANSPORTAL_ID' , '') .
            '&password=' . Settings::get('KNET_TRANSPORTAL_PASS' , '') .
            '&action=1&langid=USA&currencycode=414&amt=' . $application->package->price .
            '&responseURL=' . $callback .
            '&errorURL=' . $callback .
            '&trackid=' . $application->id .
            '&udf1=' . $application->id .
            '&udf2=&udf3=&udf4=&udf5=';

        //echo $param; echo "<hr>";
        $param = self::encryptAES($param, $TERM_RESOURCE_KEY) . '&tranportalId=' . Settings::get('KNET_TRANSPORTAL_ID' , '') . '&responseURL=' . $callback . '&errorURL=' . $callback;

        $payredirectUrl = $PAYMENT_REQUEST_URL . $param;

        $application->price = $application->package->price;
        $application->gateway = 'knet';
        $application->save();
        return redirect()->to($payredirectUrl);

    }

    public static function knetCallback(Request $request,Application $application = null)
    {
        // failed transaction from KNET
        return array(false , 'Failed check transaction!' , 'invoice id' , 'invoice reference' , $application);

        // success transaction from KNET
        return array(true , null , 'invoice id' , 'invoice reference' , $application);

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


    private static function encryptAES($str, $key)
    {
        $str = self::pkcs5_pad($str);
        $encrypted = openssl_encrypt($str, 'AES-128-CBC', $key, OPENSSL_ZERO_PADDING, $key);
        $encrypted = base64_decode($encrypted);
        $encrypted = unpack('C*', ($encrypted));
        $encrypted = self::byteArray2Hex($encrypted);
        $encrypted = urlencode($encrypted);

        return $encrypted;
    }

    private static function pkcs5_pad($text)
    {
        $blocksize = 16;
        $pad = $blocksize - (strlen($text) % $blocksize);

        return $text . str_repeat(chr($pad), $pad);
    }

    private static function byteArray2Hex($byteArray)
    {
        $chars = array_map('chr', $byteArray);
        $bin = implode($chars);

        return bin2hex($bin);
    }
}
