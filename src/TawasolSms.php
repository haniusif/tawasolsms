<?php

namespace Haniusif\TawasolSms;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TawasolSms
{
    protected $url;
    protected $accessKey;
    protected $sid;

    public function __construct()
    {
        // Define the base URL for the Tawasol SMS API
        $this->url = config('tawasolsms.api_url', 'https://tawasolsms.com:8582/websmpp');
        $this->accessKey = config('tawasolsms.accesskey');
        $this->sid = config('tawasolsms.sid');
    }

    /**
     * Send SMS to a mobile number
     *
     * @param string $mobileNumber The recipient's mobile number
     * @param string $message The message to send
     * @param int $type The type of the message (default is 1 for English)
     * @param string $respformat The format of the response (default is 'json')
     * @return array|bool Response from the SMS API or false on failure
     * @throws \Exception
     */
    public function sendSms($mobileNumber, $message, $type = 1, $respformat = 'json')
    {
        if (empty($this->url) || empty($this->accessKey) || empty($this->sid)) {
            throw new \Exception("Missing API credentials");
        }

        // Construct the request URL
        $requestUrl = "{$this->url}/websms?accesskey={$this->accessKey}&sid={$this->sid}&mno={$mobileNumber}&type={$type}&text=" . urlencode($message) . "&respformat={$respformat}";

        // Send the request
        $response = Http::get($requestUrl);

        // Log the error if the response fails
        if ($response->failed()) {
            Log::error('SMS API call failed', ['response' => $response->body()]);
        }

        // Return the response if successful
        if ($response->successful()) {
            return $response->json();
        }

        return false;
    }

    /**
     * Send a scheduled SMS to a mobile number
     *
     * @param string $mobileNumber The recipient's mobile number
     * @param string $message The message to send
     * @param string $gmt The GMT offset (e.g. +0300)
     * @param string $scheduledTime The scheduled time in yyyyMMddHHmm format
     * @param int $type The type of the message (default is 1 for English)
     * @param string $respformat The format of the response (default is 'json')
     * @return array|bool Response from the SMS API or false on failure
     * @throws \Exception
     */
    public function sendScheduledSms($mobileNumber, $message, $gmt, $scheduledTime, $type = 1, $respformat = 'json')
    {
        if (empty($this->url) || empty($this->accessKey) || empty($this->sid)) {
            throw new \Exception("Missing API credentials");
        }

        // Construct the request URL for scheduled SMS
        $requestUrl = "{$this->url}/websms?accesskey={$this->accessKey}&sid={$this->sid}&mno={$mobileNumber}&type={$type}&text=" . urlencode($message) . "&gmt={$gmt}&schtime={$scheduledTime}&respformat={$respformat}";

        // Send the request
        $response = Http::get($requestUrl);

        // Log the error if the response fails
        if ($response->failed()) {
            Log::error('Scheduled SMS API call failed', ['response' => $response->body()]);
        }

        // Return the response if successful
        if ($response->successful()) {
            return $response->json();
        }

        return false;
    }

    /**
     * Remove a scheduled SMS batch
     *
     * @param string $scheduleId The ID of the scheduled batch to be removed
     * @return array|bool Response from the SMS API or false on failure
     * @throws \Exception
     */
    public function removeScheduledSms($scheduleId)
    {
        if (empty($this->url) || empty($this->accessKey)) {
            throw new \Exception("Missing API credentials");
        }

        // Construct the remove schedule URL
        $requestUrl = "{$this->url}/removeschedule?accesskey={$this->accessKey}&scheduleid={$scheduleId}";

        // Send the request to remove the scheduled batch
        $response = Http::get($requestUrl);

        // Log the error if the response fails
        if ($response->failed()) {
            Log::error('Remove Scheduled SMS API call failed', ['response' => $response->body()]);
        }

        // Return the response if successful
        if ($response->successful()) {
            return $response->json();
        }

        return false;
    }

    /**
     * Check the status of a previously sent SMS using the response ID (respid)
     *
     * @param string $respid The response ID of the SMS
     * @return array|bool Response from the SMS API or false on failure
     * @throws \Exception
     */
    public function checkStatus($respid)
    {
        if (empty($this->url) || empty($this->accessKey)) {
            throw new \Exception("Missing API credentials");
        }

        // Construct the status enquiry URL
        $requestUrl = "{$this->url}/websmsstatus?respid={$respid}";

        // Send the request to check the status
        $response = Http::get($requestUrl);

        // Log the error if the response fails
        if ($response->failed()) {
            Log::error('SMS Status API call failed', ['response' => $response->body()]);
        }

        // Return the response if successful
        if ($response->successful()) {
            return $response->json();
        }

        return false;
    }

    /**
     * Get the SMS account balance
     *
     * @param string $respformat The format of the response (default is 'json')
     * @return array|bool The balance report or false on failure
     * @throws \Exception
     */
    public function getBalance($respformat = 'json')
    {
        if (empty($this->url) || empty($this->accessKey)) {
            throw new \Exception("Missing API credentials");
        }

        // Construct the balance report URL
        $requestUrl = "{$this->url}/balanceReport?accesskey={$this->accessKey}&respformat={$respformat}";

        // Send the request
        $response = Http::get($requestUrl);

        // Return the balance report if successful
        if ($response->successful()) {
            return $response->json();
        }

        return false;
    }
}
