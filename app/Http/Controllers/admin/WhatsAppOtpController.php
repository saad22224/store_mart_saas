<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WhatsAppOtp;
use App\Models\User;
use App\Services\WhatsAppService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class WhatsAppOtpController extends Controller
{
    protected WhatsAppService $whatsAppService;

    public function __construct(WhatsAppService $whatsAppService)
    {
        $this->whatsAppService = $whatsAppService;
    }

    public function sendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Mobile number is required.']);
        }

        $mobile = $request->input('mobile');

        // Check if user already exists
        $userExists = User::where('mobile', $mobile)->where('is_deleted', 2)->exists();
        if ($userExists) {
            return response()->json(['success' => false, 'message' => trans('messages.unique_mobile') ?? 'Mobile number already registered.']);
        }

        // Generate OTP
        $otpCode = rand(100000, 999999);

        // Save or update OTP record
        $otpRecord = WhatsAppOtp::updateOrCreate(
            ['mobile' => $mobile],
            [
                'otp' => $otpCode,
                'expires_at' => Carbon::now()->addMinutes(10),
                'is_verified' => false,
            ]
        );

        // Send OTP via WhatsApp
        $message = "رمز التحقق الخاص بك هو: {$otpCode}";
        $response = $this->whatsAppService->sendMessage($mobile, $message);

        if ($response['success']) {
            return response()->json(['success' => true, 'message' => 'OTP sent successfully.']);
        }

        return response()->json(['success' => false, 'message' => 'Failed to send OTP. Please try again.']);
    }

    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|string',
            'otp' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => 'Invalid data.']);
        }

        $mobile = $request->input('mobile');
        $otp = $request->input('otp');

        $otpRecord = WhatsAppOtp::where('mobile', $mobile)
            ->where('otp', $otp)
            ->first();

        if (!$otpRecord) {
            return response()->json(['success' => false, 'message' => 'Invalid OTP.']);
        }

        if ($otpRecord->isExpired()) {
            return response()->json(['success' => false, 'message' => 'OTP has expired.']);
        }

        $otpRecord->update(['is_verified' => true]);

        return response()->json(['success' => true, 'message' => 'OTP verified successfully.']);
    }
}
