<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
  function __construct() {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');

    $this->load->helper('security');
    $this->load->model('basic_model');
  }

  function index() {
    $this->load->view('login');
  }

  function do_login() {
    $username = $this->input->post('usernameAssets');
    $password = $this->input->post('passwordAssets');
    // $remember = $this->input->post('rememberAssets');
    $user = $this->basic_model->validate_user($username, md5($password))->row();
    if ($user) {
      $userData = array(
        'user_idAssets' => $user->hash_id,
		'employee_id' => $user->employee_id
      );
      $this->session->set_userdata('assets', $userData);
      if ($remember)
        set_cookie($userData);
      redirect('/');
    } else {
      $this->session->set_flashdata('unsuccess', 'Sorry, Wrong username or password');
      redirect('wee');
    }
  }

  function logout() {
    $this->session->sess_destroy();
    delete_cookie('user_idAssets');
		redirect('login');
  }

}
