<?php

/* Pack resources to one bundle */

class res_pack {

  public static function make_bundle() {
  	$css = [
      $_SERVER['DOCUMENT_ROOT'].'/dev/bootstrap/css/bootstrap-3.3.7.min.css',
      $_SERVER['DOCUMENT_ROOT'].'/dev/bootstrap/css/bootstrap-theme.min.css',
      $_SERVER['DOCUMENT_ROOT'].'/dev/lib.min.css',
      $_SERVER['DOCUMENT_ROOT'].'/dev/style.min.css'
    ];

    // For mobile.css
    $css2 = [
      $_SERVER['DOCUMENT_ROOT'].'/dev/bootstrap/css/bootstrap-3.3.7.min.css',
      $_SERVER['DOCUMENT_ROOT'].'/dev/bootstrap/css/bootstrap-theme.min.css',
      $_SERVER['DOCUMENT_ROOT'].'/dev/lib.min.css',
      $_SERVER['DOCUMENT_ROOT'].'/dev/style.min.css',
      $_SERVER['DOCUMENT_ROOT'].'/dev/style_mobile.min.css',
  	];

  	$js = [
      $_SERVER['DOCUMENT_ROOT'].'/dev/jquery-3.2.1.min.js',
      $_SERVER['DOCUMENT_ROOT'].'/dev/bootstrap/js/bootstrap-3.3.7.min.js',
      $_SERVER['DOCUMENT_ROOT'].'/dev/lib.min.js',
      $_SERVER['DOCUMENT_ROOT'].'/dev/script.min.js'
  	];

    @unlink($_SERVER['DOCUMENT_ROOT'].'/res/js/bundle.js');
    @unlink($_SERVER['DOCUMENT_ROOT'].'/res/css/bundle.css');
    @unlink($_SERVER['DOCUMENT_ROOT'].'/res/css/bundle_mobile.css');

  		foreach ($css as $key => $value) {
  			file_put_contents($_SERVER['DOCUMENT_ROOT'].'/res/css/bundle.css', file_get_contents($value), FILE_APPEND);
  		}
  		foreach ($js as $key => $value) {
  			file_put_contents($_SERVER['DOCUMENT_ROOT'].'/res/js/bundle.js', file_get_contents($value), FILE_APPEND);
  		}
      foreach ($css2 as $key => $value) {
  			file_put_contents($_SERVER['DOCUMENT_ROOT'].'/res/css/bundle_mobile.css', file_get_contents($value), FILE_APPEND);
  		}

  	unset($css, $css2, $js);
  }

}
