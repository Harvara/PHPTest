<?php

require_once "Message.php";
require_once "MessageMeta.php";

class Message {
    private $content;
    private $timestamp;
    private $sender;
    private $meta;

    const MESSAGE_SERVER = "147.9.2.3";

    public function __construct($content){
        $this->content=$content;
        $this->meta= new MessageMeta("127.0.0.1","AF:00:00:00");
    }

    public function setMessage($content){
        $this->content=$content;
    }

    public function getContent(){
        return $this->content;
    }

    public function checkMeta($ip){
        return $this->meta->checkSenderIP($ip);
    }

    public function contactMessageServer(){
        echo "Could not reach server at ". self::MESSAGE_SERVER ;
    }

}