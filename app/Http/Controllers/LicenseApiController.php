<?php

namespace App\Http\Controllers;

use App\Models\License;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LicenseApiController extends Controller
{
    private $secretKey = 'super_secret_server_key';

    public function verifyLicense(Request $request)
    {
        $request->validate([
            'key' => 'required|string',
            'device_id' => 'required|string'
        ]);

        $licenseKey = $request->input('key');
        $deviceId = $request->input('device_id');

        $license = License::where('license_key', $licenseKey)->first();

        if (!$license) {
            return response()->json([
                'valid' => false,
                'message' => 'Invalid license'
            ], 401);
        }

        // Check if license is expired
        if ($license->isExpired()) {
            return response()->json([
                'valid' => false,
                'message' => 'License has expired'
            ], 401);
        }

        // Check if license is already bound to another device
        if ($license->device_id && $license->device_id !== $deviceId) {
            return response()->json([
                'valid' => false,
                'message' => 'License already used on another device'
            ], 403);
        }

        // Bind license to device if not already bound
        if (!$license->device_id) {
            $license->update([
                'device_id' => $deviceId,
                'activated_at' => now()
            ]);
        }

        // Generate signature
        $licensePayload = "{$licenseKey}:{$deviceId}";
        $signature = $this->signLicense($licensePayload);

        return response()->json([
            'valid' => true,
            'key' => $licenseKey,
            'device_id' => $deviceId,
            'user' => $license->user,
            'expires' => $license->expires->format('Y-m-d'),
            'signature' => $signature
        ]);
    }

    private function signLicense($data)
    {
        $signature = hash_hmac('sha256', $data, $this->secretKey, true);
        return base64_encode($signature);
    }
}