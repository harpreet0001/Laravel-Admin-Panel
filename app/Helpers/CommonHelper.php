<?php

namespace App\Helpers;
use App\Models\User;
use App\Models\UserOtp;
use Twilio\Rest\Client;
use Twilio\TwiML\VoiceResponse;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CommonHelper
{
    public const STATUS_ENABLED = 1;
    public const STATUS_DISABLED = 2;

    /**
     * Generate OTP using the country and phone.
     *
     * @param  string  $country
     * @param  string  $phone
     * @return \App\Models\UserOtp
     */
    public static function generateOtp(string $country, string $phone)
    {
        $customer = User::where(function ($qery) use ($country, $phone) {
            $qery->where('phone', $phone)
                ->where('phone_country', $country);
        })->first('id');

        $otp = rand(1111, 9999);

        if ( !\App::environment('production')) {
            $otp = 1234;
        }

        $userOtp = UserOtp::create([
            'phone_country' => $country,
            'phone' => $phone,
            'otp' => $otp,
            'user_id' => $customer ? $customer->id : null
        ]);

        return $userOtp;
    }

     /**
     * Send OTP to the cstomer via twillio.
     */
    public static function sendSms($userOtp, string $num, string $text = '')
    {
        try {
            $otp=$userOtp;
            if($userOtp instanceof UserOtp){
                $otp=$userOtp->otp;
            }
         
            if ( !\App::environment('production') &&  !in_array(str_replace("+","",$num), ["6280407767"])) {
                if($userOtp instanceof UserOtp)
                $userOtp->update(['sent_at' => now()]);

                return true;
            }

            if ($text === '') {
                $text = 'Welcome to Brunch Me. Use this code to verify your mobile number: ' . $otp;
            }
            $client = new Client(config('constants.twilio_sid'), config('constants.twilio_auth_token'));
            $message = $client->messages->create(
                $num,
                [
                    'from' => config('constants.twilio_from_number'), // From a valid Twilio number
                    'body' => $text,
                ]
            );
            if($userOtp instanceof UserOtp)
            $userOtp->update(['sent_at' => now()]);

            return $message->sid;
        } catch (Exception $exception) {
            \report($exception);

            return 111;
        }
    }

    /**
     * remove leading 0 from phone number
     */
    public static function updatePhone(string $phone)
    {
        return str_replace(' ', '', ltrim($phone, '0'));
    }

    /**
     * upload base64 encoded image
     *
     * @param  string  $path
     * @param  string  $imgBlobUrl
     * @return string
     */
    public static function uploadBlobImage($path, $imgBlobUrl)
    {
        $fileName = md5(self::getRandomNumber() . time()) . '.jpeg';

        $image = base64_decode($imgBlobUrl);

        Storage::disk(config('constants.image_path.driver'))->put($path . $fileName, $image, 'public');

        return $fileName;
    }

    /**
     * upload image to storage folder
     *
     * @param  string  $path
     * @param  string  $file
     * @return string
     */
    public static function uploadImage($path, $file)
    {
        $fileName = md5(hexdec(uniqid()) . time()) . '.' . $file->getClientOriginalExtension();
        Storage::disk(config('constants.image_path.driver'))->put($path . $fileName,File::get($file), 'public');
        return $fileName;
    }

    /**
     * generate and return random number
    */
    public static function getRandomNumber()
    {
        return hexdec(uniqid());
    }

}    