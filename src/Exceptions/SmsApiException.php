<?php


namespace Cyaoz94\Sms123\Exceptions;


class SmsApiException extends \Exception
{
    protected $message = null;

    public function __construct($msgCode, $statusMsg)
    {
        $this->message = "SMS123 API call failed. $msgCode: $statusMsg";
        parent::__construct($this->message);
    }
}
