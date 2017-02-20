<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Fmr_Inventory extends MY_Controller {

  public $path = "fmr inventory";

  function index() {
    $this->_view($this->path);
  }

  function detail($hash_id) {
    $this->_view($this->path.'/detail');
  }

  function insert() {
    $this->_view($this->path.'/insert');
  }

  function do_insert() {
    //
  }

  function update($hash_id) {
    $this->_view($this->path.'/update');
  }

  function do_update() {
    //
  }

  function delete($hash_id) {
    //
  }

}
