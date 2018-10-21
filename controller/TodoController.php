<?php

class TodoController {


    private $todoView;
    private $database;
    private $validation;


    
    public function __construct(Database $db, InputValidation $iv) {
        $this->todoView = new TodoView();
        $this->database = $db;
        $this->validation = $iv;
        $this->deleteTodo();
    }


    public function createAndSaveTodo() {
        if($this->todoView->isSubmitTodoSet()) {
            $todoText = $this->todoView->getRequestTodoText();
            $ownerID = $this->getCurrentUserID();

            if (empty($todoText) || !ctype_alnum($todoText)) {
                // Todo move to validation.
                $this->todoView->setMessage($this->validation->validateTodoInput($todoText));

            } else {
                $this->database->saveTodo(new TodoModel(-1, $ownerID, $todoText));
            }
        }
    }


    public function render() {
        $todosArray = $this->database->getTodoItemsForUser($this->getCurrentUserID());
        $todosArray = array_map(function ($todo) { return new TodoModel($todo['id'], $todo['ownerID'], $todo['text']); }, $todosArray);
        return $this->todoView->generateTodoHTML($todosArray);
    }


    public function getCurrentUserID() {
        return $this->database->getOwnerID($_SESSION['username']);
    }


    public function deleteTodo() {
        if($this->todoView->isDeleteSet()) {
            $this->database->deleteTodo($this->todoView->getDeleteID());
        }
    }
}