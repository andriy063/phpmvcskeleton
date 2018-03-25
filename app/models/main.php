<?php

/* Main page model */

class model_main extends model {

  public function get_data() {

    $data = [];

    return [
      'title' => model::$lang['main_title'],
      'data' => $data
    ];
  }

}
