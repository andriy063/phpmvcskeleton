<?php

/* Main page model */

class model_404 extends model {

  public function get_data() {

    $data = [];

    return [
      'title' => model::$lang['not_found'],
      'data' => $data
    ];
  }

}
