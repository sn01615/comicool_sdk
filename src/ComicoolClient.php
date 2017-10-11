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

    public function __construct($client_id = null, $secret = null)
    {
        if ($client_id !== null) {
            $this->client_id = $client_id;
        }
        if ($secret !== null) {
            $this->secret = $secret;
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
            'sign' => $sign,
            'timestamp' => $time
        ];
    }

    public function getComics($recent)
    {
        
    }
}

