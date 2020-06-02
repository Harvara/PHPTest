<?php


require "MessageMeta.php";

class Message {
    private $content;
    private $timestamp;
    private $sender;
    private $meta;


    public function __construct($content){
        $this->content=$content;
        $this->meta= new MessageMeta("127.0.0.1","AF:00:00:00");
    }

    public function setMessage($content){
        $this->content=$content;
    }

    public function getMessage(){
        return $this->content;
    }

    public function checkMeta($ip){
        return $this->meta->checkSenderIP($ip);
    }

}