<?php

require_once "Message.php";

class EncryptedMessage extends Message{
    
    private $encryptedContent;

    public function encrypt(){
        echo "Content: {$this->getContent()}";
        $this->encryptedContent = hash("sha256", $this->getContent());
    }

    public function getUnencryptedContent(){
        return $this->getContent();
    }

    public function getEncryptedContent(){
        return $this->encryptedContent;
    }
}   