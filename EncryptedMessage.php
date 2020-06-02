<?php


class EncryptedMessage extends Message{
    
    private $encryptedContent;

    public function encrypt(){
        echo "Content: " . $this->content;
        $this->encryptedContent = hash("sha256", $this->content);
    }

    public function getEncryptedContent(){
        return $this->encryptedContent;
    }
}