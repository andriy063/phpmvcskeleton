<?php

use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;

class lib {

  public static function get_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
  }

  public static function url_cyr_translit($to_url) {
    $url = preg_replace('/\s+/', '-', $to_url);
    $url = preg_replace("/[^a-яєіїґa-z0-9-,]/ui", "", $url);
    //$url = preg_replace("/[s]+/ui", "-", $url);
    //$url = preg_replace("/[,-]/ui", " ", $url);
    //$url = preg_replace("/[s]+/ui", "-", $url);
    return $url;
  }

  public static function ru_translit($str) {
    $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
    $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya');
    return str_replace($rus, $lat, $str);
  }

  public static function uk_translit($text) {
    $alphabet = array (
        // upper case
        'А' => 'A',     'Б' => 'B',     'В' => 'V',     'Г' => 'H',
        'ЗГ' => 'Zgh',  'Зг' => 'Zgh',  'Ґ' => 'G',     'Д' => 'D',
        'Е' => 'E',     'Є' => 'IE',    'Ж' => 'Zh',    'З' => 'Z',
        'И' => 'Y',     'І' => 'I',     'Ї' => 'I',     'Й' => 'I',
        'К' => 'K',     'Л' => 'L',     'М' => 'M',     'Н' => 'N',
        'О' => 'O',     'П' => 'P',     'Р' => 'R',     'С' => 'S',
        'Т' => 'T',     'У' => 'U',     'Ф' => 'F',     'Х' => 'Kh',
        'Ц' => 'Ts',    'Ч' => 'Ch',    'Ш' => 'Sh',    'Щ' => 'Shch',
        'Ь' => '',      'Ю' => 'Iu',    'Я' => 'Ia',    '’' => '',
        // lower case
        'а' => 'a',     'б' => 'b',     'в' => 'v',     'г' => 'h',
        'зг' => 'zgh',  'ґ' => 'g',     'д' => 'd',     'е' => 'e',
        'є' => 'ie',    'ж' => 'zh',    'з' => 'z',     'и' => 'y',
        'і' => 'i',     'ї' => 'i',     'й' => 'i',     'к' => 'k',
        'л' => 'l',     'м' => 'm',     'н' => 'n',     'о' => 'o',
        'п' => 'p',     'р' => 'r',     'с' => 's',     'т' => 't',
        'у' => 'u',     'ф' => 'f',     'х' => 'kh',    'ц' => 'ts',
        'ч' => 'ch',    'ш' => 'sh',    'щ' => 'shch',  'ь' => '',
        'ю' => 'iu',    'я' => 'ia',    '\'' => '',
    );
    return str_replace(
            array_keys($alphabet),
            array_values($alphabet),
            preg_replace(
                // use alternative variant at the beginning of a word
                array (
                    '/(?<=^|\s)Є/', '/(?<=^|\s)Ї/', '/(?<=^|\s)Й/',
                    '/(?<=^|\s)Ю/', '/(?<=^|\s)Я/', '/(?<=^|\s)є/',
                    '/(?<=^|\s)ї/', '/(?<=^|\s)й/', '/(?<=^|\s)ю/',
                    '/(?<=^|\s)я/',
                ),
                array (
                    'Ye', 'Yi', 'Y', 'Yu', 'Ya', 'ye', 'yi', 'y', 'yu', 'ya',
                ),
                $text)
        );
  }

  public static function send_email($whom, $subject, $html) {
    if (!is_array($whom)) { $whom = [$whom]; }

    $mail = new PHPMailer;
    $mail->SMTPDebug = 3;

    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->Host = model::$smtp_host; // Specify main and backup SMTP servers
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = model::$smtp_login; // SMTP username
    $mail->Password = model::$smtp_password; // SMTP password
    $mail->SMTPSecure = 'ssl'; // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465; // TCP port to connect to
    $mail->CharSet = 'UTF-8';

    $mail->setFrom(model::$smtp_from, 'Mail');

    foreach($whom as $k => $v) {
      $mail->addBCC($v);
    }

    //$mail->addAttachment($_SERVER['DOCUMENT_ROOT'].'/...'); // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg'); // Optional name

    $mail->isHTML(true); // Set email format to HTML

    $mail->Subject = $subject;
    // Gmail fix
    $mail->Body = "<div class='mail".mt_rand(000,9999)."'>".$html."</div>";

    //$mail->AltBody = ''; // ONLY TEXT

    if(!$mail->send()) {
      echo 'Mailer Error: ' . $mail->ErrorInfo;
      return false;
    } else {
      return true;
    }
  }

  public static function http_get($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    //curl_setopt($curl, CURLOPT_POST, 1);
    //curl_setopt($curl, CURLOPT_POSTFIELDS, $postStr);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt( $curl, CURLOPT_AUTOREFERER, true );
    curl_setopt( $curl, CURLOPT_CONNECTTIMEOUT, 8 );
    curl_setopt( $curl, CURLOPT_TIMEOUT, 8 );
    curl_setopt( $curl, CURLOPT_FOLLOWLOCATION, true );
    curl_setopt( $curl, CURLOPT_MAXREDIRS, 10 );
    curl_setopt( $curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36" );
    curl_setopt($curl, CURLOPT_COOKIEJAR, $_SERVER['DOCUMENT_ROOT'].'/res/txt/cookie.txt');
    curl_setopt($curl, CURLOPT_COOKIEFILE, $_SERVER['DOCUMENT_ROOT'].'/res/txt/cookie.txt');
    $res = curl_exec($curl);
    curl_close($curl);
    return preg_replace(['/<!--(.*?)-->/s','/\>[^\S ]+/s','/[^\S ]+\</s','/(\s)+/s'],['','>','<','\\1'],$res);
  }

  public static function format_date($var) {
    $shift = 0 * 3600;
    if (date('Y', $var) == date('Y', time())) {
  		if ((time() - $var) < 60)
  			return model::$lang['justNow'];
  		if ((time() - $var) < 75)
  			return model::$lang['minuteAgo'];
      if (date('z', $var + $shift) == date('z', time() + $shift))
        return model::$lang['today'].', ' . date("H:i", $var + $shift);
      if (date('z', $var + $shift) == date('z', time() + $shift) - 1)
        return model::$lang['yesterday'].', ' . date("H:i", $var + $shift);
    }
    return date("d.m.Y / H:i", $var + $shift);
  }

  public static function trim_all($text) {
    $text = preg_replace('/\s+/', ' ', $text);
    return trim(preg_replace( "/[\t\r\n]+/", ' ', $text));
  }

  public static function trim_all_fields($array) {
    foreach ($array as $key => $value) {
      if (!is_array($value)) {
        $array[$key] = trim($value);
      } else {
        $array[$key] = self::trim_all_fields($value);
      }
    }
    return $array;
  }

  public static function display_pagination($base_url, $start, $max_value, $num_per_page) {
			if ($start >= $max_value) {
				return '';
			} else {
			$neighbors = 2;
			if ($start >= $max_value)
					$start = max(0, (int)$max_value - (((int)$max_value % (int)$num_per_page) == 0 ? $num_per_page : ((int)$max_value % (int)$num_per_page)));
			else
					$start = max(0, (int)$start - ((int)$start % (int)$num_per_page));
			$base_link = '<li><a href="' . strtr($base_url, array('%' => '%%')) . 'page=%d' . '">%s</a></li>';
			$out[] = $start == 0 ? '' : sprintf($base_link, $start / $num_per_page, '&larr;');
			if ($start > $num_per_page * $neighbors)
					$out[] = sprintf($base_link, 1, '1');
			if ($start > $num_per_page * ($neighbors + 1))
					$out[] = '<li><a>..</a></li>';
			for ($nCont = $neighbors; $nCont >= 1; $nCont--)
					if ($start >= $num_per_page * $nCont) {
							$tmpStart = $start - $num_per_page * $nCont;
							$out[] = sprintf($base_link, $tmpStart / $num_per_page + 1, $tmpStart / $num_per_page + 1);
					}
			$out[] = '<li class="active"><a>' . ($start / $num_per_page + 1) . '</a></li>';
			$tmpMaxPages = (int)(($max_value - 1) / $num_per_page) * $num_per_page;
			for ($nCont = 1; $nCont <= $neighbors; $nCont++)
					if ($start + $num_per_page * $nCont <= $tmpMaxPages) {
							$tmpStart = $start + $num_per_page * $nCont;
							$out[] = sprintf($base_link, $tmpStart / $num_per_page + 1, $tmpStart / $num_per_page + 1);
					}
			if ($start + $num_per_page * ($neighbors + 1) < $tmpMaxPages)
					$out[] = '<li><a>..</a></li>';
			if ($start + $num_per_page * $neighbors < $tmpMaxPages)
					$out[] = sprintf($base_link, $tmpMaxPages / $num_per_page + 1, $tmpMaxPages / $num_per_page + 1);
			if ($start + $num_per_page < $max_value) {
					$display_page = ($start + $num_per_page) > $max_value ? $max_value : ($start / $num_per_page + 2);
					$out[] = sprintf($base_link, $display_page, '&rarr;');
			}
			return implode(' ', $out);
			}
	}

}
