<?php

/* Main page */

class controller_main extends controller {

  function __construct() {
    $this->model = new model_main();
    $this->view = new view();
  }

	public function index() {

    $data = $this->model->get_data();
    $this->view->generate('main.php', 'template.php', $data);
  }
}
