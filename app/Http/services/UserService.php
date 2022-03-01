<?php


namespace App\Http\services;


class UserService
{
    public function getUserData($url){
        return $this->sendCurlRequest($url);
    }

    /**
     * @param $url
     * @return mixed
     */
    public function sendCurlRequest($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $result = json_decode($response);
        curl_close($ch);
        return $result;
    }
}
