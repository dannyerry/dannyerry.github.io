<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_Management extends MY_Controller {

  public $path = "user management";

  function user_list() {
    $this->_view($this->path.'/user_list/index');
  }

  function get_data_user_list() {
	$filter1 = $this->input->post('filter1');
    $value1 = $this->input->post('value1');
    $users = $this->basic_model->get_users($filter1, $value1)->result();
    $data = array();
    $no = $_POST['start'];
    foreach ($users as $row) {
      $no++;
      $rowTable = array();
      $rowTable[] = $no;
      $rowTable[] = $row->fullname;
      $rowTable[] = $row->username;
      $rowTable[] = $row->group_name;
      (($row->is_deleted == 0) ? $rowTable[] = "Active" : $rowTable[] = "Inactive");
      $url_update = base_url('user_management/user_list/update/'.$row->id);
      $rowTable[] = '<a href="'.$url_update.'"><button class="btn btn-primary" title="edit data"><i class="fa fa-pencil"></i></button></a>';
      $data[] = $rowTable;
    }
    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->basic_model->count_get_all_users(),
      "recordsFiltered" => $this->basic_model->count_get_all_users_filtered($filter1, $value1),
      "data" => $data,
    );
    echo json_encode($output);
  }

  function user_list_insert() {
    $data['user_groups'] = $this->basic_model->get_user_groups()->result();
    $this->_view($this->path.'/user_list/insert', $data);
  }

  function user_list_do_insert() {
    $data['name'] = $this->input->post('fullname');
    $data['username'] = $this->input->post('username');
    if ($this->input->post('password') == $this->input->post('confirm_password'))
      $data['password'] = md5($this->input->post('password'));
    else {
      $this->session->set_flashdata('unsuccess', 'Sorry, Error Message');
      redirect('user_management/user_list');
    }
    $data['user_group_id'] = $this->input->post('user_group');
    $data['hash_id'] = $this->create_hash_id('users');
    $data['is_deleted'] = $this->input->post('status');
    if ($this->basic_model->insert_user($data))
      redirect('user_management/user_list');
    else {
      $this->session->set_flashdata('unsuccess', 'Sorry, Error Message');
      redirect('user_management/user_list');
    }
  }

  function user_list_update($hash_id) {
    $data['user'] = $this->basic_model->get_user($hash_id)->row();
    $data['user_groups'] = $this->basic_model->get_user_groups()->result();
    $this->_view($this->path.'/user_list/update', $data);
  }

  function user_list_do_update() {
    $hash_id = $this->input->post('id');
    $data['name'] = $this->input->post('fullname');
    $data['username'] = $this->input->post('username');
    if ($this->input->post('password') == $this->input->post('confirm_password'))
      $data['password'] = md5($this->input->post('password'));
    $data['user_group_id'] = $this->input->post('user_group');
    $data['is_deleted'] = $this->input->post('status');
    if ($this->basic_model->update_user($hash_id, $data))
      redirect('user_management/user_list');
    else {
      $this->session->set_flashdata('unsuccess', 'Sorry, Error Message');
      redirect('user_management/user_list');
    }
  }

  //----------------------------------------------------------------------------

  function user_groups() {
    $this->_view($this->path.'/user_groups/index');
  }

  function get_data_user_groups() {
		$filter1 = $this->input->post('filter1');
    $value1 = $this->input->post('value1');
    $users = $this->basic_model->get_user_groups($filter1, $value1)->result();
    $data = array();
    $no = $_POST['start'];
    foreach ($users as $row) {
      $no++;
      $rowTable = array();
      $rowTable[] = $no;
      $rowTable[] = $row->name;
      $rowTable[] = $row->description;
      $url_update = base_url('user_management/user_groups/update/'.$row->hash_id);
      $rowTable[] = '<a href="'.$url_update.'"><button class="btn btn-primary" title="edit data"><i class="fa fa-pencil"></i></button></a>';
      $data[] = $rowTable;
    }
    $output = array(
      "draw" => $_POST['draw'],
      "recordsTotal" => $this->basic_model->count_get_all_user_groups(),
      "recordsFiltered" => $this->basic_model->count_get_all_user_groups_filtered($filter1, $value1),
      "data" => $data,
    );
    echo json_encode($output);
  }

  function user_groups_insert() {
    $menuInsert = $this->basic_model->get_menu()->result();
    foreach ($menuInsert as $row) {
      if ($row->parent_id == 0) {
        $data['menuInsert'][$row->id] = array(
          'menuId' => $row->id,
          'menuName' => $row->name,
          'actView' => $row->act_view,
          'actInsert' => $row->act_insert,
          'actUpdate' => $row->act_update,
          'actDelete' => $row->act_delete
        );
      } else {
        if ($row->parent_parent_id == 0) {
          $data['menuInsert'][$row->parent_id]['childs'][$row->id] = array(
            'menuId' => $row->id,
            'menuName' => $row->name,
            'actView' => $row->act_view,
            'actInsert' => $row->act_insert,
            'actUpdate' => $row->act_update,
            'actDelete' => $row->act_delete
          );
        } else {
          $data['menuInsert'][$row->parent_parent_id]['childs'][$row->parent_id]['childs'][$row->id] = array(
            'menuId' => $row->id,
            'menuName' => $row->name,
            'actView' => $row->act_view,
            'actInsert' => $row->act_insert,
            'actUpdate' => $row->act_update,
            'actDelete' => $row->act_delete
          );
        }
      }
    }
    $this->_view($this->path.'/user_groups/insert', $data);
  }

  function user_groups_do_insert() {
    $data['name'] = $this->input->post('group_name');
    $data['description'] = $this->input->post('description');
    $data['hash_id'] = $this->create_hash_id('user_groups');
    $data['is_deleted'] = $this->input->post('status');
    $last_id = $this->basic_model->insert_user_group($data);
    if ($last_id) {
      $menuInsert = $this->basic_model->get_menu()->result();
      $view = $this->input->post('view');
      $insert = $this->input->post('insert');
      $update = $this->input->post('update');
      $delete = $this->input->post('delete');
      foreach ($menuInsert as $row) {
        $data1['user_group_id'] = $last_id;
        $data1['menu_id'] = $row->id;
        (!empty($view[$row->id]) ? $data1['act_view'] = 1 : $data1['act_view'] = '0');
        (!empty($insert[$row->id]) ? $data1['act_insert'] = 1 : $data1['act_insert'] = '0');
        (!empty($update[$row->id]) ? $data1['act_update'] = 1 : $data1['act_update'] = '0');
        (!empty($delete[$row->id]) ? $data1['act_delete'] = 1 : $data1['act_delete'] = '0');
        $this->basic_model->insert_user_access($data1);
      }
      redirect('user_management/user_groups');
    } else {
      $this->session->set_flashdata('unsuccess', 'Sorry, Error Message');
      redirect('user_management/user_groups');
    }
  }

  function user_groups_update($hash_id) {
    $data['user_group'] = $this->basic_model->get_user_group($hash_id)->row();
    $user_access = $this->basic_model->get_user_access("", $hash_id)->result();
    foreach ($user_access as $row) {
      if ($row->parent_id == 0) {
        $data['menuInsert'][$row->menu_id] = array(
          'menuId' => $row->menu_id,
          'menuName' => $row->menu_name,
          'actView' => $row->act_view,
          'actInsert' => $row->act_insert,
          'actUpdate' => $row->act_update,
          'actDelete' => $row->act_delete
        );
      } else {
        if ($row->parent_parent_id == 0) {
          $data['menuInsert'][$row->parent_id]['childs'][$row->menu_id] = array(
            'accessId' => $row->id,
            'menuId' => $row->menu_id,
            'menuName' => $row->menu_name,
            'actView' => $row->act_view,
            'actInsert' => $row->act_insert,
            'actUpdate' => $row->act_update,
            'actDelete' => $row->act_delete,
            'actViewMenu' => $row->act_view_menu,
            'actInsertMenu' => $row->act_insert_menu,
            'actUpdateMenu' => $row->act_update_menu,
            'actDeleteMenu' => $row->act_delete_menu,
          );
        } else {
          $data['menuInsert'][$row->parent_parent_id]['childs'][$row->parent_id]['childs'][$row->menu_id] = array(
            'accessId' => $row->id,
            'menuId' => $row->menu_id,
            'menuName' => $row->menu_name,
            'actView' => $row->act_view,
            'actInsert' => $row->act_insert,
            'actUpdate' => $row->act_update,
            'actDelete' => $row->act_delete,
            'actViewMenu' => $row->act_view_menu,
            'actInsertMenu' => $row->act_insert_menu,
            'actUpdateMenu' => $row->act_update_menu,
            'actDeleteMenu' => $row->act_delete_menu,
          );
        }
      }
    }
    $this->_view($this->path.'/user_groups/update', $data);
  }

  function user_groups_do_update() {
    $hash_id = $this->input->post('id');
    $data['name'] = $this->input->post('group_name');
    $data['description'] = $this->input->post('description');
    $data['is_deleted'] = $this->input->post('status');
    if ($this->basic_model->update_user_group($hash_id, $data)) {
      $user_access = $this->basic_model->get_user_access("", $hash_id)->result();
      $view = $this->input->post('view');
      $insert = $this->input->post('insert');
      $update = $this->input->post('update');
      $delete = $this->input->post('delete');
      foreach ($user_access as $row) {
        (!empty($view[$row->id]) ? $data1['act_view'] = 1 : $data1['act_view'] = '0');
        (!empty($insert[$row->id]) ? $data1['act_insert'] = 1 : $data1['act_insert'] = '0');
        (!empty($update[$row->id]) ? $data1['act_update'] = 1 : $data1['act_update'] = '0');
        (!empty($delete[$row->id]) ? $data1['act_delete'] = 1 : $data1['act_delete'] = '0');
        $this->basic_model->update_user_access($row->id, $data1);
      }
      redirect('user_management/user_groups');
    } else {
      $this->session->set_flashdata('unsuccess', 'Sorry, Error Message');
      redirect('user_management/user_groups');
    }
  }

}
