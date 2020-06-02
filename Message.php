<?php

class Message {
    private $content;
    private $timestamp;
    private $sender;


    function __construct($content){
        $this->content=$content;
    }

    function setMessage($content){
        $this->content=$content;
    }

    function getMessage(){
        return $this->content;
    }

}