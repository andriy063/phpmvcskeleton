<?php
class controller_act extends controller {

  function __construct() {
    $this->model = new model_act();
    $this->view = new view();
  }

  function logout() {
    $this->model->logout();
  }

  function login() {
    if (!empty($_POST['email']) && (!filter_var(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL) === false) && !empty($_POST['password']) && preg_match("/^[^\s]{1,32}$/ui", $_POST['password'])) {
      controller::renderJSON( $this->model->login() );
    } else {
      self::renderJSON( [ 'status' => 'error', 'data' => ['message' => model::$lang['loginError']] ] );
    }
  }

  function reg() {

    $errors = [];

    /* Name verification, else - JSON with error message (same behaviour in next cases below) */
    if (!empty($_POST['name']) && preg_match("/^[a-zа-яёґєїі. '-]{2,55}$/iu", $_POST['name'])) {
      /* Email verification */
      if (!empty($_POST['email']) && (!filter_var(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL) === false)) {
        /* Password verification */
        if (!empty($_POST['password']) && preg_match("/^[^\s]{1,32}$/ui", $_POST['password'])) {
          /* Date of birth verification */
          if (!empty($_POST['day']) && !empty($_POST['month']) && !empty($_POST['year']) && preg_match("/^\d{1,2}[\.]\d{1,2}[\.](\d\d){1,2}$/", $_POST['day'].'.'.$_POST['month'].'.'.$_POST['year'])) {
            /* Is sex param correct? */
            if (!empty($_POST['sex']) && ($_POST['sex'] === '1' || $_POST['sex'] === '2' || $_POST['sex'] === '3')) {

              /* Verification of successfull file upload */
              //if ( !empty($_FILES['file']) && ($_FILES['file']['error'] === 0) && ($_FILES['file']['size'] < 1000000) ) {

                /* Cellphone checking */
                if (!empty($_POST['cellphone']) && preg_match("/^\+380[0-9]{9}$/i", $_POST['cellphone'])) {

                  /* Sends request to Model, and then renders answer from Model */
                  controller::renderJSON( $this->model->reg() );

                } else {
                  $errors[] = 'cpError';
                }

              //} else {
                //$errors[] = 'imageUploadError';
              //}

            } else {
              $errors[] = 'uncaughtError';
            }
          } else {
            $errors[] = 'dateOfBirthError';
          }
        } else {
          $errors[] = 'passError';
        }
      } else {
        $errors[] = 'emailError';
      }
    } else {
      $errors[] = 'nameError';
    }

    /* If at least one error exists, this will show error message */
    if ( !empty($errors['0']) ) {
      self::renderJSON( [ 'status' => 'error', 'data' => ['message' => model::$lang[$errors['0']]] ] );
    }

  }

  function index() {
    controller::renderJSON(['status' => 'success', 'data' => ['message' => 'Hi there / PHP MVC Skeleton'] ]);
  }

}
