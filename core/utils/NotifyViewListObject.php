<?php

/**
 * Created by PhpStorm.
 * User: Paolo
 * Date: 01/01/2017
 * Time: 17:21
 */
class NotifyViewListObject implements JsonSerializable
{
    private $idNotify;
    private $href;
    private $text;
    private $read;

    /**
     * NotifyViewListObject constructor.
     * @param $idNotify
     * @param $href
     * @param $text
     * @param $readNotRead
     */
    public function __construct($idNotify, $href, $text, $read)
    {
        $this->idNotify = $idNotify;
        $this->href = $href;
        $this->text = $text;
        $this->read = $read;
    }

    /**
     * @return mixed
     */
    public function getIdNotify()
    {
        return $this->idNotify;
    }

    /**
     * @return mixed
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function getRead()
    {
        return $this->read;
    }

    /**
     * @param mixed $idNotify
     */
    public function setIdNotify($idNotify)
    {
        $this->idNotify = $idNotify;
    }

    /**
     * @param mixed $href
     */
    public function setHref($href)
    {
        $this->href = $href;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @param mixed $readNotRead
     */
    public function setRead($read)
    {
        $this->read= $read;
    }


    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        return [
            "idNotify" => $this->getIdNotify(),
            "href" => $this->getHref(),
            "text" => $this->getText(),
            "read" => $this->getRead()
        ];
    }
}