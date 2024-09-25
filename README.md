# Tawasol SMS Laravel Package

The **Tawasol SMS Laravel Package** is an unofficial module designed to easily integrate SMS functionality into any Laravel project. It provides API endpoints to send SMS messages, check SMS balances, and track delivery statuses using the Tawasol API. It supports SMS messages in multiple formats, including English, Unicode, and Arabic.

## Features
- Send SMS messages via Tawasol SMS API.
- Check SMS balance.
- Track message delivery status.
- Supports English, Unicode, and Arabic messages.

## Installation

You can install the package via Composer. If you are using it as a local package, follow the steps below:


1. Run the following command to install the package:

    ```bash
    composer require haniusif/tawasolsms
    ```

2. Publish the configuration file:

    ```bash
    php artisan vendor:publish --tag=config --provider="Haniusif\\TawasolSms\\TawasolSmsServiceProvider"
    ```
    Create a config file config/tawasolsms.php for user credentials and API settings:
    ```bash
    <?php

    return [
    'api_url' => env('TAWASOL_SMS_API_URL', 'https://tawasolsms.com:8582/websmpp/websms'),
    'user' => env('TAWASOL_SMS_USER', ''),
    'pass' => env('TAWASOL_SMS_PASS', ''),
    'sid' => env('TAWASOL_SMS_SID', ''),
     ];

    ```

3. After publishing the configuration file, add your Tawasol SMS credentials in the .env file:
   ```bash
   TAWASOL_SMS_API_URL=https://tawasolsms.com:8582/websmpp/websms
   TAWASOL_SMS_USER=your_user
   TAWASOL_SMS_PASS=your_password
   TAWASOL_SMS_SID=your_sender_id
   ```

## Usage
### Sending SMS

You can send an SMS using the TawasolSms facade:

 
```bash
use Haniusif\TawasolSms\Facades\TawasolSms;

$recipient = '9665XXXXXXXX';
$message = 'Hello, this is a test message!';

// Send SMS
$response = TawasolSms::sendSms($recipient, $message);
```

### Checking SMS Balance

To check your SMS balance:

```bash

use Haniusif\TawasolSms\Facades\TawasolSms;

$balance = TawasolSms::getBalance();
```

### Checking Message Status

You can check the status of a message (e.g., delivered, pending) using the message_id you get when you send an SMS:


```bash
use Haniusif\TawasolSms\Facades\TawasolSms;

$messageId = '123456789';
$status = TawasolSms::checkStatus($messageId);
```
### Available Methods

    sendSms($mobileNumber, $message, $type = 1): Sends an SMS message. The $type can be 1 (English), 2 (Unicode), or 4 (Arabic).

    getBalance(): Retrieves the current SMS balance.
    
    checkStatus($messageId): Checks the status of a previously sent message using the messageId.

## License

This package is open-sourced software licensed under the MIT license.
