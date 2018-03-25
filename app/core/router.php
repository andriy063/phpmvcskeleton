<?php

/* App router */

class router {

    public static $currentController = 'main';
    public static $routes = [];

    public static function start() {

        mb_internal_encoding("UTF-8");

        //header("Access-Control-Allow-Origin: *");

        // URL parts to array
        router::$routes = explode('/', $_SERVER['REQUEST_URI']);

        /* If URL similar to /uk/... */
        if ( in_array(router::$routes['1'], model::$app_lang_codes) ) {

          model::$app_lang_code = router::$routes['1']; /* Setting up system language by URL */

          /* If URL similar to /uk/controller/... */
          if ( !empty(router::$routes['2']) ) {
            $controllerName = explode('?', router::$routes['2'])['0']; /* Setting up current controller */
            self::$currentController = $controllerName; /* Updating name of controller for View's logic */
          } else {
            $controllerName = 'main'; /* ..or default controller */
          }

          /* If URL similar to /uk/controller/action/?foo=bar... */
          if ( !empty(router::$routes['3']) && (substr(router::$routes['3'], 0, 1) != '?') ) {
            $actionName = explode('?', router::$routes['3'])['0']; /* Setting up current action */
          } else {
            $actionName = 'index'; /* ..or default action */
          }

        } else {
          // If lang code wasn't set in URL, redirect with default lang code
          header('HTTP/1.1 301 Moved Permanently');
          header('location: /'.model::$app_lang_code);
          exit;
        }

        if (empty($controllerName)) { $controllerName = 'main'; }

        /* This includes Controller file or, if not exist, generates 404 Error */
        if (!@include('app/controllers/'.$controllerName.'.php')) {
          controller::error_404();
        }

        /* This includes Model file (named same as Controller) */
        include('app/models/'.$controllerName.'.php');

        /* Finnaly, Controller startup */
        $controller = 'controller_'.$controllerName;
        $controller = new $controller;

        /* Calls action, if exists, otherwise - 404 Error */
        if ( method_exists($controller, $actionName) ) {
          $controller->$actionName();
        } else {
          controller::error_404();
          //$controller->index();
        }
    }
}
