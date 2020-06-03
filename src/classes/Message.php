<?php

require_once "MessageMeta.php";

class Message {
    private $content;
    private $timestamp;
    private $sender;
    private $meta;

    public static $defaultContent = "This is the message Content";
    const MESSAGE_SERVER = "147.9.2.3";

    public function __construct($content=false){
        if (!$content){
            $content = Message::$defaultContent;
        }
        if(gettype($content)==="array"){
            $this->createNewMessagefromArray($content);
        }else{
            $this->content=$content;
        }
        $this->meta= new MessageMeta("127.0.0.1","AF:00:00:00");
    }

    private function  createNewMessagefromArray($content){
        if (sizeof($content)>0){
            $this->content=$content["Content"];
            $this->sender=$content["SenderIP"];
        }else{
            $this->content=Message::$defaultContent;
        }
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

    public  function printMessage(){
        echo "Content: " . $this->content .  " - Sender: " . $this->sender . PHP_EOL;
    }


}