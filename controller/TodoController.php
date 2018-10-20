<?php

class TodoController {


    private $todoView;
    private $database;

    public function __construct(Database $db) {
        $this->todoView = new TodoView();
        $this->database = $db;

    }

    public function createTodo() {
        if($this->todoView->isSubmitTodoSet()) {
            $todoText = $this->todoView->getRequestTodoText();
            $ownerID = $this->database->getOwnerID($_SESSION['username']);
            echo 'createTodo';
            echo $_SESSION['username'];
            echo  $todoText;
            //echo $ownerID;
            $this->database->saveTodo(new TodoModel($ownerID, $todoText));

        }
    }

}