<?php
class controller_404 extends controller {

  function __construct() {
    $this->model = new model_404();
    $this->view = new view();
  }

  function index() {
    $data = $this->model->get_data();
    $this->view->generate('404.php', 'template.php', $data);
  }

}
?>