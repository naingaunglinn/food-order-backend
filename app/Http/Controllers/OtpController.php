<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class OtpController extends Controller
{    
    /**
     * Request OTP for the provided phone number.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function requestOtp(Request $request)
    {
        Log::info("OTP for access");
        try {
            // Validate request parameters
            $request->validate([
                'phone' => 'required',
            ]);

            // Generate OTP
            $otp = rand(100000, 999999);

            // Store OTP temporarily in cache for 5 minutes (for validation)
            Cache::put('otp_' . $request->phone, $otp, now()->addMinutes(5));

            // Simulate OTP sending to phone number (You can use services like Twilio/Firebase)
            // Firebase SMS or another service can be used here to actually send OTP.

            // For now, log the OTP in the console for testing purposes.
            Log::info("OTP for {$request->phone}: {$otp}");

            // Return the OTP as a response (remove this in production)
            return response()->json(['success' => true, 'otp' => $otp]);

        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('Error generating OTP for phone ' . $request->phone . ': ' . $e->getMessage());

            // Return a 500 error response with the error message
            return response()->json([
                'success' => false,
                'error' => 'An error occurred while generating OTP. Please try again later.',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
