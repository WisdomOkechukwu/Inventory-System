<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Mail\VerificationMail;
use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ForgotPasswordController extends Controller
{
    public function forgot_password(){
        return view('v1.auth.forgot_password');
    }

    public function check_mail(Request $request){
        $user = User::where('email', $request->email)->first();
        
        if(!$user){
            return redirect()->back()->with('error', 'Email does not exist');
        }
        
        if($user->role != 'admin'){
            return redirect()->back()->with('error', 'Reach out to your admin to change your password');
        }

        Session::put('email', $request->email);

        $code = rand(100000, 999999);
        $expiry_time = now()->addMinutes(30);

        VerificationCode::where('email', $request->email)->update([
            'status' => 'expired'
        ]);

        $verification_code = new VerificationCode();
        $verification_code->email = $request->email;
        $verification_code->otp = $code;
        $verification_code->expiry_time = $expiry_time;
        $verification_code->save();
        
        Mail::to($request->email)->send(new VerificationMail($code, 'Forgot Password Request', $user->name));
        return redirect()->route('verify_otp_view');
    }

    public function verify_otp_view(){
        if(!Session::has('email')){
            return redirect()->route('forgot.password')->with('error', 'Error processing request. Please try again');
        }

        $email = Session::get('email');
        return view('v1.auth.verify_otp',compact('email'));
    }

    public function verify_otp(Request $request){

        $verification_code = VerificationCode::where('otp', $request->otp)
            ->where('status','pending')
            ->first();
        
        if(!$verification_code){
            return redirect()->back()->with('error', 'Invalid OTP');
        }

        if(now() > $verification_code->expiry_time){
            return redirect()->back()->with('error', 'OTP has expired');
        }

        return redirect()->route('reset_password_view');
    }

    public function reset_password_view(){
        if(!Session::has('email')){
            return redirect()->route('forgot.password')->with('error', 'Error processing request. Please try again');
        }

        $email = Session::get('email');
        return view('v1.auth.reset_password', compact('email'));
    }

    public function reset_password(Request $request){
        $request->validate([
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')->with('success', 'Password reset successfully.');
    }
}
