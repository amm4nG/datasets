<?php

namespace App\Http\Controllers;

use App\Mail\VerificationCodeEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    public function sendCodeVerification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
        ], [
            'email.required' => 'Harap masukkan email Anda'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => $validator->errors()->first(),
            ]);
        }
        try {
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Email tidak ditemukan',
                ]);
            }

            $codeVerification = Str::random(6);
            $user->password = Hash::make($codeVerification);
            $user->update();

            Mail::raw("Ini adalah kode verifikasi akun DATAU anda $codeVerification, jangan berikan kepada siapapun", function ($message) use ($request) {
                $message->to($request->email)->subject('Code Verification');
            });

            return response()->json([
                'status' => 200,
                'message' => 'Kami telah mengirim kode verifikasi ke email Anda',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function verify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code_verification' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => $validator->errors()->first(),
            ]);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->code_verification])) {
            return response()->json([
                'status' => 200,
                'message' => 'Verifikasi berhasil',
            ]);
        }

        return response()->json([
            'status' => 422,
            'message' => 'Kode verifikasi tidak sesuai',
        ]);
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => $validator->errors()->first(),
            ]);
        }

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->update();
        return response()->json([
            'status' => 200,
            'message' => 'Password berhasil dirubah',
        ]);
    }
}
