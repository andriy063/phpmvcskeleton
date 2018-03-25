<?php
class model {

	public static $is_mobile, $protocol, $lang, $user, $db_host, $db_name, $db_user, $db_pass, $httpsrootlang, $httpsroot, $db, $admin_email, $cache_var, $this_page_url, $smtp_host, $smtp_login, $smtp_password, $smtp_from, $per_page;

	public static $app_lang_code = 'uk'; // Default language
	public static $app_lang_codes = ['uk', 'en'];

	/* Application loading */

	function __construct() {

		ini_set('memory_limit', '-1');
		error_reporting(E_ALL);
		ini_set('display_errors', 1);

		// Composer
		require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

		// Pack js/css to bundle, run always on dev or once before production !
		res_pack::make_bundle();

		// DB connect
		
		self::$db_host = 'localhost';
		self::$db_name = 'n';
		self::$db_user = 'n';
		self::$db_pass = 'p';

		// SMTP settings
		self::$smtp_host = 'www';
		self::$smtp_login = 'login';
		self::$smtp_password = 'pwd';
		self::$smtp_from = 'from@a.com';

		// System settings
		self::$cache_var = time(); // JS / CSS cache variable (script.js?v=$cache_var)
		self::$per_page = 20;
		self::$admin_email = 'adm@gmail.com';

		self::$user = ['id' => '0'];
		self::$protocol = 'http';
		self::$is_mobile = false;

		// ... maybe insecure ..
		self::$httpsroot = self::$protocol.'://'.$_SERVER['HTTP_HOST'].'';
		self::$httpsrootlang = self::$httpsroot.'/'.self::$app_lang_code;
		self::$this_page_url = self::$protocol.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

		self::check_mobile();
		self::mysqli_connect();

		// Session starting, if not started already
    if ( !session_id() ) { session_start(); }

    // CSRF-token to avoid cross-site scripting
		if ( empty($_SESSION['CSRF']) ) {
			$_SESSION['CSRF'] = bin2hex(openssl_random_pseudo_bytes(22));
		}

		// Language array
		self::$lang = parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/res/lang/'.self::$app_lang_code.'/'.self::$app_lang_code.'.ini');

		// If user logged in
		if (!empty($_SESSION['user_id'])) {
			model::$user['id'] = $_SESSION['user_id'];
		}

		self::get_user(); /* Gets user data (if logged in) */

		/* --- Tests --- */

		//var_dump( lib::send_email('aa@aa.com', 'dd', 'dd') );exit;

		//$image = new \claviska\SimpleImage();

		//var_dump(model::$user); exit;

		/* --- Tests end --- */
	}

	public static function mysqli_connect() {
		self::$db = new MysqliDb (self::$db_host, self::$db_user, self::$db_pass, self::$db_name);
		//self::$db = MysqliDb::getInstance();
	}

	public static function check_mobile() {
		if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od|ad)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$_SERVER['HTTP_USER_AGENT'])
	|| preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($_SERVER['HTTP_USER_AGENT'],0,4))) { self::$is_mobile = true; /*SetCookie("isMobile", "1", time()+25920, "/");*/ } else { /*SetCookie("isMobile", "0", time()+25920, "/");*/ self::$is_mobile = false; }
	}

	/* Gets user data (if logged in) */

	public function get_user() {

		if ( !empty($_SESSION['user_id']) ) { /* If user's auth. is valid */
			model::$db->where('id', $_SESSION['user_id']);
			model::$user = model::$db->getOne('users');
		}

    if ( (model::$user['id'] == 0) && !empty($_COOKIE['key']) ) { /* If session expired */

      try {
				/* Parsing of auth. (key) cookie */
	      $selector_and_token = explode('_', $_COOKIE['key']);

				model::$db->where('selector', $selector_and_token['0']);
				$token_data = model::$db->getOne('tokens');

        /* If token with given selector exists in DB.. */
        if ( !empty($token_data['id']) && $token_data['expires'] > time() ) {

          /* ..and it valid.. */
          if ( hash_equals( $token_data['token'], hash('sha256', $selector_and_token['1']) ) ) {

            $_SESSION['user_id'] = $token_data['user_id']; /* Auth. for session period */
            /* Updating token cookie for 7 days */
            $plus7days = time() + 604800;
            SetCookie("key", $_COOKIE['key'], $plus7days, "/");
            /* Updating token expires date for 7 days */
						model::$db->where('id', $token_data['id']);
						model::$db->update('tokens', ['expires' => $plus7days]);

						/* User data from DB */
						model::$db->where('id', $token_data['user_id']);
						model::$user = model::$db->getOne('users');

          }
        }
      } catch (Exception $e) {
        return false;
      }
    }

    return true;
	}

}
