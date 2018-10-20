<?php

class TodoModel {

    public $id;
    public $ownerID;
    public $text;


    public function __construct(int $id, int $ownerID, string $text) {
        $this->id = $id;
        $this->ownerID = $ownerID;
        $this->text = $text;
    }
}