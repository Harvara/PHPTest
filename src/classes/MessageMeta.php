<?php

class MessageMeta{
    private $senderIP;
    private $senderMAC;


    public function __construct($sIP, $MAC){
        $this->senderIP = $sIP;
        $this->senderMAC = $MAC;
    }

    public function checkSenderIP($checkIP){
       return $checkIP === $this->senderIP ? true : false;
    }
}