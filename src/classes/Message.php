<?php


require_once "MessageMeta.php";
require_once "DatabaseConnection.php";

class Message {
    private $content;
    private $timestamp;
    private $sender;
    private $meta;
    private $dbID;

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
        $members["dbID"]=0;
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
            $members["dbID"]=0;
        }
        $instance->fill($members);
        return $instance;
    }


    private function  getAttributesfromDBQuery($result) {
        $members =[];
        if(sizeof($result)>0) {
            $members["content"] = $result["Content"];
            $members["sender"] = $result["SenderIP"];
            $members["dbID"] = $result["ID"];
        }
        return $members;
    }

    private  function fill($members){
        $this->content=$members["content"];
        $this->sender=$members["sender"];
        $this->dbID = $members["dbID"];
        $this->meta= new MessageMeta("127.0.0.1","AF:00:00:00");
    }

    public function setContent($content){
        $this->content=$content;
    }

    public function getContent(){
        return $this->content;
    }

    public function checkMetaSenderIP($ip){
        return $this->meta->checkSenderIP($ip);
    }

    public function contactMessageServer(){
        echo "Could not reach server at ". self::MESSAGE_SERVER ;
    }

    public  function printMessage(){
        echo "Content: " . $this->content .  " - Sender: " . $this->sender . " - DBID: " . $this->dbID . PHP_EOL;
    }

    public function saveMessageToDB($pdo){
        if($this->dbID === 0){
            $this->saveNewMessageInDB($pdo);
        }else{
            $this->updateMessageInDB($pdo);
        }
    }

    private function saveNewMessageinDB($pdo){
        $sql = "Insert into Messages (Content, SenderIP) values (:content, :senderip)";
        $statement = $pdo->prepare($sql);
        $values=[":content" => $this->content, ":senderip" => $this->sender];
        $statement->execute($values);
    }

    private function updateMessageInDB($pdo){
        $sql = "update Messages set Content=:content, SenderIP=:senderip";
        $statement = $pdo->prepare($sql);
        $values=[":content" => $this->content, ":senderip" => $this->sender];
        $statement->execute($values);
    }


}