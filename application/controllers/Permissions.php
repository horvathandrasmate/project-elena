<?php


/**
 * @property Permissions_model Permissions_model
 */
class Permissions extends CI_Controller{

    private $has_permission;

    function __controller(){

    }
    function index(){
        //require_permission("admin");
        $this->load->view("templates/header");
        $this->load->view("templates/menu");







        $this->load->view("templates/footer");
    }

    function has_permission($user_id, $permission_name){
        $this->has_permission = $this->Permissions_model->has_permission($user_id, $permission_name);
        if($this->has_permission){
            echo "true";
        }else{
            echo "false";
        }
    }

}