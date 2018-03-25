<?php

/* Template rendering */

class view {

  public function generate($content_view, $template_view, $data = NULL) {
    if (ob_get_contents()) { ob_end_clean(); }
    
    if (is_array($data)) {
      /* Extracts sent variables (if sent) */
      extract($data);
    }

    /* If browser supports GZ compressing.. */
    if (@extension_loaded('zlib') && substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) {
      /* Compressing output */
      //ob_start('ob_gzhandler');
      ob_start();

    } else {
      /* Or output without compressing */
      ob_start();
    }

    /* HTML soft obfuscation */
    ob_start(function($b){return preg_replace(['/<!--(.*?)-->/s','/\>[^\S ]+/s','/[^\S ]+\</s','/(\s)+/s'],['','>','<','\\1'],$b);});

    /*
    ob_start(function($b){
      $filecache = $_SERVER['DOCUMENT_ROOT'].'/res/cache/html/'.md5($_SERVER[REQUEST_URI]);

      file_put_contents($filecache, $b);

      return $b;

    });*/

    /* Includes current View */
    include('app/views/'.$template_view);

  }

}
