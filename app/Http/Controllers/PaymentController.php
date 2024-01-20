<?php

namespace App\Http\Controllers;

use App\Models\Application;

class PaymentController
{
    public static function pay(Application $application){
        $callback = route('callBack' , $application->uuid);
        switch ( $application->gateway ){
            case 'creditcard':
                $method = 'creditcard';
                break;
            default :
                $method = 'knet';
                break;
        }
        return self::{$method}($application , $callback);
    }

    public static function applicationPaid(Application $application , $invoiceId = null , $invoiceReference = null , $isFree = false ){
        if ( $isFree ) {
            $application->gateway = 'local';
        }
        $application->invoiceId = $invoiceId;
        $application->invoiceReference = $invoiceReference;
        $application->paid = true;
        $application->paid_at = now();
        $application->save();
//            dispatch(new sendRegisterEmailJob($application->id));
        return redirect()->route('application.show' , ['uuid' => $application->uuid ]);
    }
}
