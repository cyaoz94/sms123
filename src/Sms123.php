<?php

namespace Cyaoz94\Sms123;

use Cyaoz94\Sms123\Exceptions\CredentialsException;
use Cyaoz94\Sms123\Exceptions\SmsApiException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Psr\Http\Message\ResponseInterface;

class Sms123
{
    protected $apiHost;
    protected $apiKey;
    protected $email;

    public function __construct()
    {
        $this->apiHost = rtrim(config('sms123.SMS123_API_HOST'), '/');
        $this->apiKey = config('sms123.SMS123_API_KEY');
        $this->email = config('sms123.SMS123_EMAIL');
    }

    /**
     * calls API using GET method
     *
     * @param $uri
     * @param array $params
     * @return ResponseInterface
     * @throws SmsApiException
     */
    private function apiGet($uri, $params = [])
    {
        $client = new Client();
        $params = array_merge($params, self::getStickyParams());

        try {
            $response = $client->get($uri, [
                'query' => $params,
                'http_error' => false,
            ]);
        } catch (GuzzleException $e) {
            throw new SmsApiException($e->getCode(), $e->getMessage());
        }

        // general response handler
        $this->responseHandler($response);

        $responseBody = $response->getBody();
        self::logApi($uri, $params, json_encode($responseBody));
        return $responseBody;
    }

    /**
     * calls API using POST method
     *
     * @param $uri
     * @param array $params
     * @return ResponseInterface
     * @throws SmsApiException
     */
    private function apiPost($uri, $params = [])
    {
        $client = new Client();
        $params = array_merge($params, self::getStickyParams());

        try {
            $response = $client->post($uri, [
                'body' => $params,
                'http_error' => false,
            ]);
        } catch (GuzzleException $e) {
            throw new SmsApiException($e->getCode(), $e->getMessage());
        }

        // general response handler
        $this->responseHandler($response);

        $responseBody = $response->getBody();
        self::logApi($uri, $params, json_encode($responseBody));
        return $responseBody;
    }

    /**
     * Get SMS123 apiKey and email params from config
     *
     * @return array
     * @throws \Throwable
     */
    private function getStickyParams()
    {
        throw_if(!($this->apiKey) || !($this->email), new CredentialsException());

        return [
            'apiKey' => $this->apiKey,
            'email' => $this->email,
        ];
    }

    /**
     * Logs API calls
     *
     * @param string $uri
     * @param array $params
     * @param string $response
     */
    private function logApi(string $uri, array $params, string $response)
    {
        if (!config('app.debug')) {
            return;
        }

        Log::info(collect([
            'uri' => $uri,
            'body' => $params,
            'response' => $response
        ]));
    }

    /**
     * Calls SMS123's API to send sms
     *
     * @param $contactNumber
     * @param $messageContent
     * @param null $referenceId
     * @throws SmsApiException
     */
    public function sendSms($contactNumber, $messageContent = '', $referenceId = null)
    {
        $uri = "{$this->apiHost}/api/send.php";
        $params = [
            'recipients' => $contactNumber,
            'messageContent' => $messageContent,
            'referenceId' => $referenceId ? $referenceId : Str::random(),
        ];

        return self::apiGet($uri, $params);
    }

    /**
     * Add template via API call
     *
     * @param $templateTitle
     * @param $messageContent
     * @param null $referenceId
     * @return ResponseInterface
     * @throws SmsApiException
     */
    public function addTemplate($templateTitle, $messageContent = '', $referenceId = null)
    {
        $uri = "{$this->apiHost}/api/smsAddTemplate.php";
        $params = [
            'templateTitle' => $templateTitle,
            'messageContent' => $messageContent,
            'referenceId' => $referenceId ? $referenceId : Str::random(),
        ];

        return self::apiPost($uri, $params);
    }

    /**
     * Gets balance from SMS123
     *
     * @return mixed
     * @throws SmsApiException
     * @throws \Throwable
     */
    public function getBalance()
    {
        $uri = "{$this->apiHost}/api/getBalance.php";

        $response = self::apiGet($uri);

        $body = json_decode((string)$response->getBody());

        // if not success msgCode
        throw_if($body['msgCode'] != 'E00001', new SmsApiException($body['msgCode'], $body['statusMsg']));

        return $body['balance'];
    }

    /**
     * To detect the error response from SMS123 API
     * https://www.sms123.net/api/SMS123APIDoc.pdf
     **/
    private function responseHandler($response)
    {
        $body = json_decode($response->getBody(), true);
        if ($body['status'] === 'error') {
            throw new SmsApiException($body['msgCode'], $body['statusMsg']);
        }
    }
}
