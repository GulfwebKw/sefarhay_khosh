<?php

namespace App\Http\Controllers;


use App\Jobs\sendRegisterEmailJob;
use App\Models\Application;
use App\Models\Status;
use Barryvdh\DomPDF\Facade\Pdf;
use HackerESQ\Settings\Facades\Settings;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use MyFatoorah\Library\PaymentMyfatoorahApiV2;

class Controller extends BaseController
{
    public function callback(Request $request , $uuid) {
        /** @var Application $application */
        $application = Application::query()
            ->where('paid' , 0)
            ->where('uuid' , $uuid)
            ->firstOrFail();
        return PaymentController::callBack($request , $application);
    }

    public function application(Request $request,$uuid){
        /** @var Application $application */
        $application = Application::query()->where('uuid' , $uuid)->firstOrFail();
        $statuses = Status::query()->orderBy('ordering')->get()->toArray();
        $msg = $request->get('msg');
        return view('application' , compact('application' , 'statuses' , 'msg' ));
    }

    public function applicationPay($uuid , $gateway){
        /** @var Application $application */
        $application = Application::query()->where('paid' , 0)->where('uuid' , $uuid)->firstOrFail();

        if (!$application->package->is_active)
            abort(404);

        if ( $application->package->price <= 0 ){
            return PaymentController::applicationPaid($application, null , null , true);
        }
        try {
            $application->gateway = $gateway;
            $application->save();
            return PaymentController::pay($application);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return redirect()->route('application.show' , ['uuid' => $application->uuid , 'msg' => trans('There was a problem connecting to the payment gateway! Please try again.') ]);
        }
    }
}
