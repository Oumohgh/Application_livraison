<?php


class Notification {
    private int $idNotification;
    private string $message;
    private bool $isRead = false;
    private DateTime $CreateAt;

    public function __construct(int $idNotification, string $message){
        $this->idNotification = $idNotification;
        $this->message = $message;
        $this->CreateAt = new DateTime();
    }

    public function getIdNotification(){ return $this->idNotification; }

    public function getMessage(){ return $this->message; }


}