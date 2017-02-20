<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Site extends MY_Controller {

  public $path = "site";

  function menu() {
    $menuInsert = $this->basic_model->get_menu()->result();
    foreach ($menuInsert as $row) {
      if ($row->parent_id == 0) {
        $data['menuInsert'][$row->id] = array(
          'hashId' => $row->hash_id,
          'menuName' => $row->name,
          'slug' => $row->slug,
          'controller' => $row->controller,
          'status' => $row->is_deleted
        );
      } else {
        if ($row->parent_parent_id == 0) {
          $data['menuInsert'][$row->parent_id]['childs'][$row->id] = array(
            'hashId' => $row->hash_id,
            'menuName' => $row->name,
            'slug' => $row->slug,
            'controller' => $row->controller,
            'status' => $row->is_deleted
          );
        } else {
          $data['menuInsert'][$row->parent_parent_id]['childs'][$row->parent_id]['childs'][$row->id] = array(
            'hashId' => $row->hash_id,
            'menuName' => $row->name,
            'slug' => $row->slug,
            'controller' => $row->controller,
            'status' => $row->is_deleted
          );
        }
      }
    }
    $this->_view($this->path.'/menu/index', $data);
  }

  function menu_insert() {
    $menuInsert = $this->basic_model->get_menu()->result();
    foreach ($menuInsert as $row) {
      if ($row->parent_id == 0) {
        $data['menuInsert'][$row->id] = array(
          'menuId' => $row->id,
          'menuName' => $row->name
        );
      } else {
        if ($row->parent_parent_id == 0) {
          $data['menuInsert'][$row->parent_id]['childs'][$row->id] = array(
            'menuId' => $row->id,
            'menuName' => $row->name
          );
        }
      }
    }
    $data['app_routes'] = $this->basic_model->get_app_routes()->result();
    $this->_view($this->path.'/menu/insert', $data);
  }

  function menu_do_insert() {
    $data['name'] = $this->input->post('menu_name');
    $data['parent_id'] = $this->input->post('parent_name');
    $data['description'] = $this->input->post('description');
    $data['app_route_id'] = $this->input->post('target');
    (!empty($this->input->post('view')) ? $data['act_view'] = '1' : $data['act_view'] = '0');
    (!empty($this->input->post('insert')) ? $data['act_insert'] = '1' : $data['act_insert'] = '0');
    (!empty($this->input->post('update')) ? $data['act_update'] = '1' : $data['act_update'] = '0');
    (!empty($this->input->post('delete')) ? $data['act_delete'] = '1' : $data['act_delete'] = '0');
    $data['hash_id'] = $this->create_hash_id('menu');
    $data['is_deleted'] = $this->input->post('status');
    $last_id = $this->basic_model->insert_menu($data);
    if ($last_id) {
      $user_groups = $this->basic_model->get_user_groups()->result();
      foreach ($user_groups as $row) {
        $data1['user_group_id'] = $row->id;
        $data1['menu_id'] = $last_id;
        $data1['act_view'] = '0';
        $data1['act_insert'] = '0';
        $data1['act_update'] = '0';
        $data1['act_delete'] = '0';
        $this->basic_model->insert_item_user_access($data1);
      }
      redirect('site/menu');
    } else {
      $this->session->set_flashdata('unsuccess', 'Sorry, Error Message');
      redirect('site/menu');
    }
  }

  function menu_update($hash_id) {
    $data['currentMenu'] = $this->basic_model->get_menu($hash_id)->row();
    $menuInsert = $this->basic_model->get_menu()->result();
    foreach ($menuInsert as $row) {
      if ($row->parent_id == 0) {
        $data['menuInsert'][$row->id] = array(
          'menuId' => $row->id,
          'menuName' => $row->name
        );
      } else {
        if ($row->parent_parent_id == 0) {
          $data['menuInsert'][$row->parent_id]['childs'][$row->id] = array(
            'menuId' => $row->id,
            'menuName' => $row->name
          );
        }
      }
    }
    $data['app_routes'] = $this->basic_model->get_app_routes()->result();
    $this->_view($this->path.'/menu/update', $data);
  }

  function menu_do_update() {
    $hash_id = $this->input->post('id');
    $data['name'] = $this->input->post('menu_name');
    $data['parent_id'] = $this->input->post('parent_name');
    $data['description'] = $this->input->post('description');
    $data['app_route_id'] = $this->input->post('target');
    (!empty($this->input->post('view')) ? $data['act_view'] = '1' : $data['act_view'] = '0');
    (!empty($this->input->post('insert')) ? $data['act_insert'] = '1' : $data['act_insert'] = '0');
    (!empty($this->input->post('update')) ? $data['act_update'] = '1' : $data['act_update'] = '0');
    (!empty($this->input->post('delete')) ? $data['act_delete'] = '1' : $data['act_delete'] = '0');
    $data['is_deleted'] = $this->input->post('status');
    if ($this->basic_model->update_menu($hash_id, $data))
      redirect('site/menu');
    else {
      $this->session->set_flashdata('unsuccess', 'Sorry, Error Message');
      redirect('site/menu');
    }
  }

  //----------------------------------------------------------------------------

  function site_info() {
    $this->_view($this->path.'/site_info');
  }
}
