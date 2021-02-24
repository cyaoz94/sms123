<?php

namespace Cyaoz94\Sms123\Exceptions;

use Exception;

class CredentialsException extends Exception
{
    protected $message = 'Sms123 API key or email is missing. Please define in .env file as SMS123_API_KEY and SMS123_EMAIL';
}
