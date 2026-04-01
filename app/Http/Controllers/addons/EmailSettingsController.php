<?php

namespace App\Http\Controllers\addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use App\Helpers\helper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Config;

class EmailSettingsController extends Controller
{
    public function emailsettings(Request $request)
    {

        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $settings = Settings::where('vendor_id', $vendor_id)->first();
        $settings->mail_driver = $request->mail_driver;
        $settings->mail_host = $request->mail_host;
        $settings->mail_port = $request->mail_port;
        $settings->mail_username = $request->mail_username;
        $settings->mail_password = $request->mail_password;
        $settings->mail_encryption = $request->mail_encryption;
        $settings->mail_fromaddress = $request->mail_fromaddress;
        $settings->mail_fromname = $request->mail_fromname;
        $settings->save();
        return redirect()->back()->with('success', trans('messages.success'));
    }
    public function emailmessagesettings(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $settings = Settings::where('vendor_id', $vendor_id)->first();
        if ($request->template_type == 1) {
            $settings->forget_password_email_message = $request->forget_password_email_message;
        } elseif ($request->template_type == 2) {
            $settings->delete_account_email_message = $request->delete_account_email_message;
        } elseif ($request->template_type == 3) {
            $settings->banktransfer_request_email_message = $request->banktransfer_request_email_message;
        } elseif ($request->template_type == 4) {
            $settings->cod_request_email_message = $request->cod_request_email_message;
        } elseif ($request->template_type == 5) {
            $settings->subscription_reject_email_message = $request->subscription_reject_email_message;
        } elseif ($request->template_type == 6) {
            $settings->subscription_success_email_message = $request->subscription_success_email_message;
        } elseif ($request->template_type == 7) {
            $settings->admin_subscription_request_email_message = $request->admin_subscription_request_email_message;
        } elseif ($request->template_type == 8) {
            $settings->admin_subscription_success_email_message = $request->admin_subscription_success_email_message;
        } elseif ($request->template_type == 9) {
            $settings->vendor_register_email_message = $request->vendor_register_email_message;
        } elseif ($request->template_type == 10) {
            $settings->admin_vendor_register_email_message = $request->admin_vendor_register_email_message;
        } elseif ($request->template_type == 11) {
            $settings->vendor_status_change_email_message = $request->vendor_status_change_email_message;
        } elseif ($request->template_type == 12) {
            $settings->contact_email_message = $request->contact_email_message;
        } elseif ($request->template_type == 13) {
            $settings->new_order_invoice_email_message = $request->new_order_invoice_email_message;
        } elseif ($request->template_type == 14) {
            $settings->vendor_new_order_email_message = $request->vendor_new_order_email_message;
        } elseif ($request->template_type == 15) {
            $settings->order_status_email_message = $request->order_status_email_message;
        }
        $settings->save();
        return redirect()->back()->with('success', trans('messages.success'));
    }

    public function testmail(Request $request)
    {
        try {
            if (Auth::user()->type == 4) {
                $vendor_id = Auth::user()->vendor_id;
            } else {
                $vendor_id = Auth::user()->id;
            }
            $data = ['title' => "Congratulations! Successful SMTP Email Configuration", 'vendor_email' => $request->email_address, 'vendor_name' => Auth::user()->name, 'msg' => "I am delighted to inform you that your SMTP email configuration has been successfully set up! Congratulations on this achievement!"];
            $emaildata = helper::emailconfigration($vendor_id);
            Config::set('mail', $emaildata);
            Mail::send('email.testemail', $data, function ($message) use ($data) {
                $message->to($data['vendor_email'])->subject($data['title']);
            });
            return redirect()->back()->with('success', trans('messages.success'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', trans('messages.test_mail_fail_message'));
        }
    }
}
