<?php

namespace App\Http\Controllers\addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings;
use App\Models\Firebase;
use App\Models\User;
use App\Helpers\helper;


class FirebaseController extends Controller
{
    public function index(Request $request)
    {

        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $settingdata = Settings::where('vendor_id', $vendor_id)->first();
        $firebasecontent = Firebase::where('is_available', 1)->where('is_deleted', 2)->where('vendor_id', $vendor_id)->get();
        return view('admin.firebase.index', compact('firebasecontent', 'settingdata'));
    }
    public function savekey(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $settingdata = Settings::where('vendor_id', $vendor_id)->first();
        $settingdata->firebase = $request->firebase_server_key;
        $settingdata->update();
        return redirect()->back()->with('success', trans('messages.success'));
    }
    public function add()
    {
        return view('admin.firebase.add');
    }
    public function save(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $newfirebase = new Firebase();
        $newfirebase->vendor_id = $vendor_id;
        $newfirebase->title = $request->title;
        $newfirebase->sub_title = $request->sub_title;

        if (Auth::user()->type == 1) {
            $users = User::where('type', 2)->where('is_available', 1)->where('is_deleted', 2)->get();
        }
        if (Auth::user()->type == 2 || Auth::user()->type == 4) {
            $users = User::where('type', 3)->where('is_available', 1)->where('is_deleted', 2)->where('vendor_id', $vendor_id)->get();
        }
        foreach ($users as $user) {
            helper::push_notification($user->token, $request->title, $request->sub_title, "", '', helper::appdata($vendor_id)->firebase);
        }
        $newfirebase->save();
        return redirect('admin/notification')->with('success', trans('messages.success'));
    }
    public function edit(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $editfirebase = Firebase::where('vendor_id', $vendor_id)->where('id', $request->id)->first();
        return view('admin.firebase.edit', compact('editfirebase'));
    }
    public function resend(Request $request)
    {
        try {
            if (Auth::user()->type == 4) {
                $vendor_id = Auth::user()->vendor_id;
            } else {
                $vendor_id = Auth::user()->id;
            }
            if (Auth::user()->type == 1) {
                $users = User::where('type', 2)->where('is_available', 1)->where('is_deleted', 2)->get();
            }
            if (Auth::user()->type == 2 || Auth::user()->type == 4) {
                $users = User::where('type', 3)->where('is_available', 1)->where('is_deleted', 2)->where('vendor_id', $vendor_id)->get();
            }
            foreach ($users as $user) {
                helper::push_notification($user->token, $request->title, $request->sub_title, '', '', helper::appdata($vendor_id)->firebase);
            }
            return redirect('admin/notification')->with('success', trans('messages.success'));
        } catch (\Throwable $th) {

            return redirect('admin/notification')->with('error', trans('messages.wrong'));
        }
    }
    public function delete(Request $request)
    {
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }
        $firebase = Firebase::where('vendor_id', $vendor_id)->where('id', $request->id)->first();
        $firebase->delete();
        return redirect('admin/notification')->with('success', trans('messages.success'));
    }
}
