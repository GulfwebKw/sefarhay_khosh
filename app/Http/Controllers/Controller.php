<?php

namespace App\Http\Controllers;


use App\Jobs\sendRegisterEmailJob;
use App\Models\Application;
use Barryvdh\DomPDF\Facade\Pdf;
use HackerESQ\Settings\Facades\Settings;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
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

    public function application($uuid){
        /** @var Application $application */
        $application = Application::query()->where('uuid' , $uuid)->firstOrFail();
        return view('application' , compact('application' ));
    }

    public function applicationPay($uuid){
        /** @var Application $application */
        $application = Application::query()->where('paid' , 0)->where('uuid' , $uuid)->firstOrFail();

        if (!$application->package->is_active)
            abort(404);

        if ( $application->package->price <= 0 ){
            return PaymentController::applicationPaid($application, null , null , true);
        }
        try {
            return PaymentController::pay($application);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return redirect()->route('application.show' , ['uuid' => $application->uuid , 'msg' => 'There was a problem connecting to the payment gateway! Please try again.' ]);
        }
    }
}
