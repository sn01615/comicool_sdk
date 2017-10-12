<?php
namespace Comicool;

/**
 *
 * @author YangLong
 * Date: 2017-10-11
 */
class ComicoolClient
{

    private $client_id, $secret;

    private $api_url = 'http://api.comicool.cn/api/v2/';

    public function __construct($client_id = null, $secret = null, $api_url = null)
    {
        if ($client_id !== null) {
            $this->client_id = $client_id;
        }
        if ($secret !== null) {
            $this->secret = $secret;
        }
        if ($api_url !== null) {
            $this->api_url = $api_url;
        }
    }

    public function setClientId($client_id)
    {
        $this->client_id = $client_id;
    }

    public function setSecret($secret)
    {
        $this->secret = $secret;
    }

    private function sign($time)
    {
        return md5("comicool{$this->secret}{$time}");
    }

    private function getSign()
    {
        $time = time();
        $sign = $this->sign($time);
        return [
            'client_id' => $this->client_id,
            'sign' => $sign,
            'timestamp' => $time
        ];
    }

    public function getComics($recent = null)
    {
        $apiName = $this->getApiName(__FUNCTION__);
        $callStr = $apiName;
        return $this->call($callStr, [
            'recent' => $recent
        ]);
    }

    public function getComic($comic_id)
    {
        $apiName = $this->getApiName(__FUNCTION__);
        $callStr = $apiName;
        return $this->call($callStr, [
            'comic_id' => $comic_id
        ]);
    }

    public function getComicChapters($comic_id, $recent)
    {
        $apiName = $this->getApiName(__FUNCTION__);
        $callStr = $apiName;
        return $this->call($callStr, [
            'comic_id' => $comic_id,
            'recent' => $recent
        ]);
    }

    public function getComicChapter($comic_id, $chapter_id)
    {
        $apiName = $this->getApiName(__FUNCTION__);
        $callStr = $apiName;
        return $this->call($callStr, [
            'comic_id' => $comic_id,
            'chapter_id' => $chapter_id
        ]);
    }

    private function getApiName($functionName)
    {
        $apiName = lcfirst(substr($functionName, 3));
        $apiName = preg_replace('/([A-Z])/', '/$1', $apiName);
        $apiName = strtolower($apiName);
        return $apiName;
    }

    private function call($url, $args = [])
    {
        $url .= "?" . http_build_query(array_merge($this->getSign(), $args));
        $json = $this->doCall($url);
        $json = json_decode($json);
        return $json;
    }

    private function doCall($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->api_url . $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}

