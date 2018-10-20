<?php

class TodoModel {

    public $ownerID;
    public $text;


    public function __construct(int $ownerID, string $text) {
        $this->ownerID = $ownerID;
        $this->text = $text;
    }
}
