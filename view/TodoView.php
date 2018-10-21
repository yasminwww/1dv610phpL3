<?php

class TodoView {

    private static $submitTodo = 'TodoView::SubmitTodo';
    private static $todoText = 'TodoView::TodoText';
    private static $deleteTodo = 'TodoView::DeleteTodo';
    private static $todoID = 'TodoView::TodoID';
    private $message;

    public function  generateTodoListHTML(array $todos) {
        $items = '';
        foreach ($todos as $todo) {
            $items .= "
                <li class='list-group-item'>
                    $todo->text
                    <form method='POST'>

                        <input name='" . self::$todoID . "' value='$todo->id'  type='hidden'>
                    
                        <input type='submit' class='btn btn-warning float-right' name='". self::$deleteTodo . "' value='Delete'>
                    </form>
                </li>";
        }
                        
        return "<div class=list>
                    <h3>Todo's: </h3>
                    <ul class='list-group list-group-flush'>
                        $items
                    </ul>
                </div>";
    }

    public function generateTodoHTML(array $todos) {
        $response = '<form method="POST">
                        <p>' . $this->message . '</p>
                        <div class="form-group row">
                        <input type="text"  class="form-control" id="inputTodo" name="'. self::$todoText .'" placeholder="Please enter a Todo here">
                        <input type="submit" class="btn btn-warning" name="' . self::$submitTodo . '" value="Save">
                        </div>
                     </form><br>
        ' . $this->generateTodoListHTML($todos);
        return $response;
    }


    public function isSubmitTodoSet() : bool {
        return isset($_POST[self::$submitTodo]);
    }


    public function isDeleteSet() : bool {
        return isset($_POST[self::$deleteTodo]);
    }

    public function getDeleteID() : int {
        return (isset($_POST[self::$todoID]) ? $_POST[self::$todoID] : -1);
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    public function getRequestTodoText() {
        return (isset($_POST[self::$todoText]) ? $_POST[self::$todoText] : '');
    }
}