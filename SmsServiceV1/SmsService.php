<?php

namespace SmsServiceV1;

use Bitrix\Main\Web\HttpClient;


class SmsService  implements SmsServiceInterface {

    private $accessKey;
    private $secretKey;

    const REQUEST_SMS_SEND_URL = 'http://test-site.ru/api1/send_sms';
    const REQUEST_SMS_INFO_URL = 'http://test-site.ru/api1/info';

    /**
     * SmsService constructor.
     * @param string $access_key
     * @param string $secret_key_hash
     */
    public function __construct($access_key, $secret_key_hash) {
        $this->accessKey = $access_key;
        $this->secretKey = $secret_key_hash;

    }

    /**
     * @param $url
     * @param $postData
     * @return mixed
     */

    private function sendRequest($url, $postData) {

        $httpClient = new HttpClient();
        $data = $httpClient->post($url, $postData);
        $data = json_decode($data, true);
        return $data;
    }

    public function send($phoneNumber, $smsText) {

        $postData = array(
            'access_key' => $this->accessKey,
            'secret_key_hash' => sha1($this->secretKey),
            'target' => $phoneNumber,
            'content' => $smsText,
        );

        $data = $this->sendRequest(self::REQUEST_SMS_SEND_URL, $postData );
        return new SendResponse($data['id'], $data['error']);
    }

    public function smsStatus($id) {

        $postData = array(
            'access_key' => $this->accessKey,
            'secret_key_hash' => sha1($this->secretKey),
            'id' => $id,
        );

        $data = $this->sendRequest(self::REQUEST_SMS_INFO_URL, $postData );

        return new StatusResponse($data['info']['created'],$data['info']['active'], $data['info']['delivered'], $data['info']['target'], $data['info']['error']);

    }
}
