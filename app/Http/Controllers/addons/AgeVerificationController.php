<?php

namespace App\Http\Controllers\addons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AgeVerification;
use Illuminate\Support\Facades\Auth;
class AgeVerificationController extends Controller
{
    public function age_verification(Request $request)
    {  
        if (Auth::user()->type == 4) {
            $vendor_id = Auth::user()->vendor_id;
        } else {
            $vendor_id = Auth::user()->id;
        }

        $age_verification = AgeVerification::where('vendor_id',$vendor_id)->first();
        if($age_verification == null || empty($age_verification))
        {
            $age_verification = new AgeVerification();
            $age_verification->vendor_id = $vendor_id;
            $age_verification->age_verification_on_off = isset($request->age_verification_on_off) ? 1 : 2;
            $age_verification->popup_type = $request->popup_type;
            $age_verification->min_age = $request->min_age;
            $age_verification->save();
        }
        else
        {
            $age_verification->age_verification_on_off = isset($request->age_verification_on_off) ? 1 : 2;
            $age_verification->popup_type = $request->popup_type;
            $age_verification->min_age = $request->min_age;
            $age_verification->update();
        }

        return redirect()->back()->with('success', trans('messages.success'));
    }
}
