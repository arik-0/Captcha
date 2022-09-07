<?php

class Captcha
{
    protected $secretKey = '0xC7E7c303b46729F17BAc9eF2e452B0cD6594554b';
    protected $captchaVerificationEndpoint = 'https://hcaptcha.com/siteverify';

    public function checkCaptcha($response)
    {
        $responseData = json_decode($this->verifyCaptcha([
            'secret' => $this->secretKey,
            'response' => $response
        ]));

        return $responseData->success;
    }

    protected function verifyCaptcha($data)
    {
        $verify = curl_init();
        curl_setopt($verify, CURLOPT_URL, $this->captchaVerificationEndpoint);
        curl_setopt($verify, CURLOPT_POST, true);
        curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);

        return curl_exec($verify);
    }
}
