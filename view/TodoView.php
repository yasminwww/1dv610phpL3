<?php

class TodoView {

    private static $submitTodo = 'TodoView::SubmitTodo';
    private static $todoLink = 'todo';
    private static $todoText = 'TodoView::TodoText';



  public function  generateToDoListHTML() {

    return '<div class=list>
                <h3>To do </h3>
                <ul>
                    <li class="todo">Some function</li>
                </ul>
            </div>';
    }

    public function generateToDoHTML() {
        $response = '<form method="POST" action="?'. self::$todoLink .'" />
                        <input type="text" name="'. self::$todoText .'" placeholder="Please enter a Todo here" />
                        <input type="submit" name="' . self::$submitTodo . '" value="Save" />
                     </form><br>
        ' . $this->generateToDoListHTML();

        return $response;
    }

    public function isSubmitTodoSet() {
        return isset($_POST[self::$submitTodo]);
    }
    public function getRequestTodoText() {
        return (isset($_POST[self::$todoText]) ? $_POST[self::$todoText] : '');
    }
}