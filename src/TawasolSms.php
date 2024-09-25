<?php

namespace Haniusif\TawasolSms;

use Illuminate\Support\Facades\Http;

class TawasolSms
{
    protected $url;
    protected $user;
    protected $pass;
    protected $sid;

    public function __construct()
    {
        $this->url = config('tawasolsms.api_url');
        $this->user = config('tawasolsms.user');
        $this->pass = config('tawasolsms.pass');
        $this->sid = config('tawasolsms.sid');
    }

    public function sendSms($mobileNumber, $message, $type = 1)
    {
        $requestUrl = "{$this->url}?user={$this->user}&pass={$this->pass}&sid={$this->sid}&mno={$mobileNumber}&type={$type}&text=" . urlencode($message);


        if (empty($this->url) || empty($this->user) || empty($this->pass) || empty($this->sid)) {
            throw new \Exception("Missing API credentials");
        }

        $response = Http::get($requestUrl);


        if ($response->successful()) {
            return $response->json();
        }

        return false;
    }

    public function getBalance()
    {
        $requestUrl = "{$this->url}/balanceReport?user={$this->user}&pass={$this->pass}";

        $response = Http::get($requestUrl);

        if ($response->successful()) {
            return $response->json();
        }

        return false;
    }
}
