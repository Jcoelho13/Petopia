<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\MailModel;
use Symfony\Component\Mailer\Exception\TransportException;
use Exception;
use App\Models\GlobalUser;
use App\Models\Token;

class MailController extends Controller
{
    function send(Request $request) {

        $user = GlobalUser::where('email', '=', $request->email)->first();

        if (!$user) {
            return redirect()->back()->withInput()->withErrors(['invalid_email' => 'Invalid email']);
        }

        $missingVariables = [];
        $requiredEnvVariables = [
            'MAIL_MAILER',
            'MAIL_HOST',
            'MAIL_PORT',
            'MAIL_USERNAME',
            'MAIL_PASSWORD',
            'MAIL_ENCRYPTION',
            'MAIL_FROM_ADDRESS',
            'MAIL_FROM_NAME',
        ];

        foreach ($requiredEnvVariables as $envVar) {
            if (empty(env($envVar))) {
                $missingVariables[] = $envVar;
            }
        }
            if (empty($missingVariables)) {
                $tokenValue = bin2hex(random_bytes(32));

                $token = Token::create([
                    'token_value' => $tokenValue,
                    'user_id' => $user->id,
                ]);

                $mailData = [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $request->email,
                    'token' => $tokenValue
                ];

                try {
                    Mail::to($request->email)->send(new MailModel($mailData));
                    $message = 'Foi enviado um email de recuperação para ' . $request->email;
                } catch (TransportException $e) {
                    $message = 'SMTP connection error occurred during the email sending process to ' . $request->email;
                } catch (Exception $e) {
                    $message = 'An unhandled exception occurred during the email sending process to ' . $request->email;
                    \Log::error($e->getMessage());
                }
            } else {
                $message = 'The SMTP server cannot be reached due to missing environment variables:';
            }

            $request->session()->flash('message', $message);
            $request->session()->flash('details', $missingVariables);

        if ($message == 'Foi enviado um email de recuperação para ' . $request->email) {
            return redirect(route('login'));
        } else if ($message == 'The SMTP server cannot be reached due to missing environment variables:') {
            return redirect(route('home'));
        }
        else if ($message == 'SMTP connection error occurred during the email sending process to ' . $request->email) {
            return redirect(route('faq'));
        }
        else if ($message == 'An unhandled exception occurred during the email sending process to ' . $request->email) {
            return redirect(route('about-us'));
        }
    }
}
