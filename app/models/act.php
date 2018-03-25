<?php
class model_act extends model {

  public function logout() {
    if ( !empty(model::$user['id']) ) {
      if (!empty($_COOKIE['key'])) {
        $selector_and_token = explode('_', $_COOKIE['key']);
        model::$db->where( 'selector', $selector_and_token['0'] );
        model::$db->where( 'user_id', model::$user['id'] );
				$token_deleted = model::$db->delete('tokens');
      }

      SetCookie("key", '', time()-259200, "/");
			$_SESSION = [];
			session_destroy();
    }

    header("location: /".self::$app_lang_code."/");
    exit;
  }

  public function login() {
    model::$db->where('email', mb_strtolower($_POST['email']));
    $exist = model::$db->getOne('users');
    if (!empty($exist['id']) && password_verify($_POST['password'], $exist['password']) ) {
      $_SESSION['user_id'] = $exist['id'];
      if ( !empty($_POST['remember']) ) {
        self::long_term_login($exist['id']);
      }
      return ['status' => 'success', 'data' => ['message' => 'Login successful']];
    } else {
      return ['status' => 'error', 'data' => ['message' => 'Login error']];
    }
  }

  private function long_term_login($id) {

    $selector = bin2hex(openssl_random_pseudo_bytes(6));
    $token = bin2hex(openssl_random_pseudo_bytes(32)); /* Unique auth. token */
		$token_sha256 = hash('sha256', $token); /* Hash from token */

    $arr = [
      'user_id' => $id,
      'selector' => $selector,
      'token' => $token_sha256,
      'expires' => time() + 604800 /* 7 days to token expires */
    ];
    $ins = model::$db->insert('tokens', $arr);
    SetCookie("key", $selector.'_'.$token, time() + 604800, "/");

    return $ins;
  }

  public function reg() {

    $current_time = time();

    $arr = [
      'login' => explode('@', $_POST['email'])['0']."_".uniqid(),
      'bday' => date('Y-m-d', mktime(0, 0, 0, $_POST['month'], $_POST['day'], $_POST['year'])),
      'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
      'rights' => 1,
      'last_time' => $current_time,
      'time' => $current_time,
      'name' => $_POST['name'],
      'email' => mb_strtolower($_POST['email']),
      'cellphone' => $_POST['cellphone'],
      'updated' => $current_time,
      'sex' => $_POST['sex']


    ];

    $ins = model::$db->insert('users', $arr);
    if ($ins) {
      $_SESSION['user_id'] = $ins;
      return ['status' => 'success', 'data' => ['d' => $ins, 'message' => 'ok']];
    } else {
      return ['status' => 'error', 'data' => ['d' => $ins, 'message' => 'Maybe you\'re registered already']];
    }

  }
}
