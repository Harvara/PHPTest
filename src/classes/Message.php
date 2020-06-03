<?php

require_once "MessageMeta.php";

class Message {
    private $content;
    private $timestamp;
    private $sender;
    private $meta;

    public static $defaultContent = "This is the message Content";
    const MESSAGE_SERVER = "147.9.2.3";

    public  function  __construct(){

    }

    public function withContentAndSender($content = false, $sender){
        $instance= new self();
        if (!$content){
            $content = Message::$defaultContent;
        }
        if(gettype($content)==="array"){
            $members = $this->getAttributesfromDBQuery($content);
        }else{
            $members["content"]=$content;
        }
        $members["sender"]=$sender;
        $instance->fill($members);
        return $instance;
    }

    public function withContent($content=false){
        $instance = new self();
        if (!$content){
            $content = Message::$defaultContent;
        }
        if(gettype($content)==="array"){
            $members = $instance->getAttributesfromDBQuery($content);
        }else{
            $members["content"]=$content;
            $members["sender"]="127.0.0.1";
        }
        $instance->fill($members);
        return $instance;
    }


    private function  getAttributesfromDBQuery($result) {
        $members =[];
        if(sizeof($result)>0) {
            $members["content"] = $result["Content"];
            $members["sender"] = $result["SenderIP"];
        }
        echo "MEmber Content: " . $members["content"].PHP_EOL;
        return $members;
    }

    private  function fill($members){
        $this->content=$members["content"];
        $this->sender=$members["sender"];
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

    public  function printMessage(){
        echo "Content: " . $this->content .  " - Sender: " . $this->sender . PHP_EOL;
    }


}