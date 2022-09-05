<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Stripe;
use DB;
use Auth;
use Session;
use Notification;
use Carbon\Carbon;

class PaymentController extends Controller
{

    public function userPayment(Request $request){
        
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
            "amount" => $request->amount * 100,
            "currency" => "MYR",
            "source" => $request->stripeToken,
            "description" => "This payment is testing purpose of mental health system.",
        ]);
        
        $appointment=Appointment::find($request->id);
        $r=request();
        $appointment->status='complete';
        $orders->save();

        return redirect()->route('appointment.view');
    }
}
