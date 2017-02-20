<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class basic_model extends CI_Model {

  function validate_user($username, $password) {
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where('username', $username);
    $this->db->where('password', $password);
    return $query = $this->db->get();
  }

  function get_user($hash_id) {
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where('hash_id', $hash_id);
    return $query = $this->db->get();
  }

  function get_site() {
    $this->db->select('*');
    $this->db->from('sites');
    return $query = $this->db->get();
  }

  function get_user_access($id = "", $hash_id = "") {
    $this->db->select('a.*, b.id as menu_id, b.parent_id, b.name as menu_name, b.target as menu_target, b.icon as menu_icon, c.parent_id as parent_parent_id, b.act_view as act_view_menu, b.act_insert as act_insert_menu, b.act_update as act_update_menu, b.act_delete as act_delete_menu');
    $this->db->from('user_access as a');
    $this->db->join('menu as b', 'b.id = a.menu_id');
    $this->db->join('menu as c', 'c.id = b.parent_id', 'left');
    if ($id != "")
      $this->db->where('a.user_group_id', $id);
    if ($hash_id != "") {
      $this->db->join('user_groups as d', 'd.id = a.user_group_id', 'left');
      $this->db->where('d.hash_id', $hash_id);
    }
    return $query = $this->db->get();
  }

  function update_user_last_login($hash_id) {
    $date = date("Y-m-d H:i:s");
    $this->db->where('hash_id', $hash_id);
    $this->db->update('users', array('last_login' => $date));
  }

//------------------------------------------------------------------------------

  function check_hash_id($param, $hash_id) {
    $this->db->select('hash_id');
    $this->db->from($param);
    $this->db->where('hash_id', $hash_id);
    return $query = $this->db->get();
  }

  //----------------------------------------------------------------------------

  function get_users($param1a = "", $param1b = "") {
    $this->db->select('a.hash_id as id, a.user_group_id, a.name as fullname, a.username, a.is_deleted, b.name as group_name');
    $this->db->from('users as a');
    $this->db->join('user_groups as b', 'b.id = a.user_group_id');
    if ($param1a != "" && $param1b != "")
      $this->db->like('a.'.$param1a, $param1b);
    if($this->input->post('length') && $this->input->post('length') != -1)
      $this->db->limit($this->input->post('length'), $this->input->post('start'));
    return $query = $this->db->get();
  }

  public function count_get_all_users() {
    $this->db->select('a.hash_id');
    $this->db->from('users as a');
    return $this->db->count_all_results();
  }

  public function count_get_all_users_filtered($param1a = "", $param1b = "") {
    $this->db->select('a.hash_id');
    $this->db->from('users as a');
    if ($param1a != "" && $param1b != "") {
      $this->db->like('a.'.$param1a, $param1b);
    }
    return $this->db->count_all_results();
  }

  function insert_user($data) {
    $this->db->insert('users', $data);
  }

  function update_user($hash_id, $data) {
    $this->db->where('hash_id', $hash_id);
    return $this->db->update('users', $data);
  }

  //----------------------------------------------------------------------------

  function get_user_groups($param1a = "", $param1b = "") {
    $this->db->select('*');
    $this->db->from('user_groups');
    if ($param1a != "" && $param1b != "")
      $this->db->like($param1a, $param1b);
    if($this->input->post('length') && $this->input->post('length') != -1)
      $this->db->limit($this->input->post('length'), $this->input->post('start'));
    return $query = $this->db->get();
  }

  public function count_get_all_user_groups() {
    $this->db->select('a.hash_id');
    $this->db->from('user_groups as a');
    return $this->db->count_all_results();
  }

  public function count_get_all_user_groups_filtered($param1a = "", $param1b = "") {
    $this->db->select('a.hash_id');
    $this->db->from('user_groups as a');
    if ($param1a != "" && $param1b != "") {
      $this->db->like($param1a, $param1b);
    }
    return $this->db->count_all_results();
  }

  public function get_menu($hash_id = "") {
    $this->db->select('a.*, b.parent_id as parent_parent_id, c.slug, c.controller');
    $this->db->from('menu as a');
    $this->db->join('menu as b', 'b.id = a.parent_id', 'left');
    $this->db->join('app_routes as c', 'c.id = a.app_route_id', 'left');
    if ($hash_id != "")
      $this->db->where('a.hash_id', $hash_id);
    return $query = $this->db->get();
  }

  function insert_user_group($data) {
    $this->db->insert('user_groups', $data);
    $insert_id = $this->db->insert_id();
    return  $insert_id;
  }

  function insert_user_access($data) {
    $this->db->insert('user_access', $data);
  }

  function get_user_group($hash_id) {
    $this->db->select('*');
    $this->db->from('user_groups');
    $this->db->where('hash_id', $hash_id);
    return $query = $this->db->get();
  }

  function update_user_group($hash_id, $data) {
    $this->db->where('hash_id', $hash_id);
    return $this->db->update('user_groups', $data);
  }

  function update_user_access($id, $data) {
    $this->db->where('id', $id);
    return $this->db->update('user_access', $data);
  }

  //----------------------------------------------------------------------------

  function get_app_routes() {
    $this->db->select('*');
    $this->db->from('app_routes');
    return $query = $this->db->get();
  }

  function insert_menu($data) {
    $this->db->insert('menu', $data);
    $insert_id = $this->db->insert_id();
    return  $insert_id;
  }

  function insert_item_user_access($data) {
    $this->db->insert('user_access', $data);
  }

  function update_menu($hash_id, $data) {
    $this->db->where('hash_id', $hash_id);
    return $this->db->update('menu', $data);
  }

}
