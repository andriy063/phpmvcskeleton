<?php
exit;
if (!empty($_GET['name'])) {

  $controller = '<?php'."\n".'class controller_'.$_GET['name'].' extends controller {

  function __construct() {
    $this->model = new model_'.$_GET['name'].'();
    $this->view = new view();
  }

  function index() {
    $data = $this->model->get_data();
    $this->view->generate(\''.$_GET['name'].'.php\', \'template.php\', $data);
  }

}';

  $model = '<?php'."\n".'class model_'.$_GET['name'].' extends model {

  public function get_data() {
    return [
      \'title\' => self::$lang[\'main_title\']
    ];
  }

}';

  $view = '';

  file_put_contents($_SERVER['DOCUMENT_ROOT'].'/app/controllers/'.$_GET['name'].'.php', $controller);
  file_put_contents($_SERVER['DOCUMENT_ROOT'].'/app/models/'.$_GET['name'].'.php', $model);
  file_put_contents($_SERVER['DOCUMENT_ROOT'].'/app/views/'.$_GET['name'].'.php', $view);

  echo 'OK';

} else {
  echo 'No "name" ';
}
