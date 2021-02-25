<?php

namespace Cyaoz94\Sms123\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Sms123Facade
 * @package Cyaoz94\Sms123\Facades
 *
 * @method static void sendSms(string $contactNumber, string|null $messageContent = '', string|null $reference_id = null)
 * @method static void addTemplate(string $templateTitle, string|null $messageContent = '', string|null $reference_id = null)
 * @method static mixed void getBalance()
 *
 * @see \Cyaoz94\Sms123\Sms123
 */
class Sms123Facade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'sms123';
    }
}
