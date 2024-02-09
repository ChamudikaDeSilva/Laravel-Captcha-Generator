<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CaptchaServiceController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function captchaFormValidate(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'username' => 'required',
                'captcha' => 'required|captcha'
            ]);

            // If validation passes without throwing an exception, captcha is correct
            return redirect()->back()->with('success', 'Captcha validation passed!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log validation errors
            Log::error('Validation Error: ' . $e->validator->errors());
            // Redirect back with error messages
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        }
    }

    public function reloadCaptcha()
    {
        try {
            return response()->json(['captcha' => captcha_img()]);
        } catch (\Exception $e) {
            // Log captcha generation error
            Log::error('Captcha Generation Error: ' . $e->getMessage());
            // Return error response
            return response()->json(['error' => 'Failed to generate captcha'], 500);
        }
    }
}
