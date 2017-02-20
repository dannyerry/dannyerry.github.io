<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

  function index() {
    $this->_view('asset/dashboard');
  }

}
