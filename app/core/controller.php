<?php
class controller {

  public $model;
  public $view;

  function __construct() {
    $this->view = new view();
  }

  /* Outputing JSON from Array */

  public static function renderJSON($data, $enable_cors = false) {
    ob_clean();
    if ($enable_cors) {
      header("Access-Control-Allow-Origin: *");
    }
    header('Content-Type: application/json; charset=utf-8');
    if (!is_array($data)) {
      echo $data;
    } else {
      echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
    exit;
  }

  /* Generates 404 Error page */

  public static function error_404($controllerName = '404') {
    if (ob_get_contents()) { ob_end_clean(); }
    header("HTTP/1.0 404 Not Found");
    router::$currentController = '404';
    include('app/controllers/'.$controllerName.'.php');
    include('app/models/'.$controllerName.'.php');
    $controller = 'controller_'.$controllerName;
    $controller = new $controller;
    $controller->index();
    exit;
  }

}
