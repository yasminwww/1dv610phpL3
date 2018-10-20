<?php

class LayoutView {
  
  public function render(bool $isLoggedIn, $v, DateTimeView $dtv, string $renderedTodoView) {
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
          <link rel="stylesheet" href="./css/main.css">
          <title>Login Example</title>
        </head>
        <body class="container">
          <h1>Assignment 2</h1>
          ' . $this->renderIsLoggedIn($isLoggedIn) . '
          
          <div class="container">
              ' . $v->response($isLoggedIn, $renderedTodoView) . '
              ' . $dtv->time() . '
          </div>
         </body>
      </html>
    ';
  }

  //public function renderTodo() 
  
  public function renderIsLoggedIn($isLoggedIn) {
    if ($isLoggedIn) {
      return '<h2>Logged in</h2>';
    }
    else {

      return '<h2>Not logged in</h2>';
    }
  }
}



