<?php

/**
 * Created by PhpStorm.
 * User: horva
 * Date: 2019.03.14.
 * Time: 19:26
 */

if (!defined('BASEPATH')) exit('Direct access allowed');

class Account extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Account_model");
        $this->load->model("Permissions_model");
    }
    function manage()
    {
        $this->load->view("templates/header");
        $this->load->view("account/manage");
        $this->load->view("templates/footer");
    }
    public function profile()
    {
        if ($this->input->post('upload_permission') !== NULL) {
            $permission_name = $this->input->post('permission_name');
            //$this->Permissions_model->test();
            try {
                $error = false;
                $this->Permissions_model->upload_permission($permission_name);
            } catch (Exception $e) {
                if ($e->getMessage() == "used_permission_name") alert_swal_error("Permission is already used"); //todo lang
                $error = true;
            }

            if (!$error) {
                alert_swal_success("Successful upload!");
            }
        }
        if ($this->input->post('add_user_to_ugroup') !== NULL) {
            $user = $this->input->post('user');
            $ugroup = $this->input->post('ugroup');
            try {
                $this->Permissions_model->change_ugroup_for_user($ugroup, $user);
            } catch (Exception $e) {
            }
        }
        $data = $this->Account_model->get_profile($this->session->userdata("username"));
        $groups = $this->Permissions_model->get_groups();
        $users = $this->Account_model->get_usernames();
        $this->load->view("templates/header");
        $this->load->view("account/profile", array("user_data" => $data, "groups" => $groups, "users" => $users));
        $this->load->view("templates/footer");
    }
    public function index()
    {
        $this->load->view("templates/header");
        $this->load->view("account/welcome");
        $this->load->view("templates/footer");
    }
    function login()
    {
        if ($this->session->userdata("logged_in")) {
            redirect(base_url("account/profile"));
        }


        if (NULL !== $this->input->post('login')) {

            $username = $this->input->post("username");
            $password = $this->input->post("password");


            try {
                $this->Account_model->login($username, $password);
            } catch (Exception $e) {
                if ($e->getMessage() == "password_dont_match") alert_swal_error(lang("wrong_password"), "account/login");
                if ($e->getMessage() == "unknown_username") alert_swal_error(lang("unknown_username"), "account/login");
                die();
            }
            alert_swal_success(lang("successful_login"), "account/login");
        } else {

            $this->load->view("templates/header");
            $this->load->view("account/login");
            $this->load->view("templates/footer");
        }
    }
    function logout()
    {
        $this->Account_model->logout();
        redirect(base_url("account/login"));
    }
    function helpthedev()
    {
        if (NULL !== $this->input->post('post')) {
            if (strlen($this->input->post("username")) < 64)
                $username = $this->input->post("username");
            if (strlen($this->input->post("title")) < 64)
                $title = $this->input->post("title");
            if (strlen($this->input->post("description")) < 64)
                $description = $this->input->post("description");
            $upload_array = array("username" => $username, "title" => $title, "description" => $description);
            try {
                $this->load->model("Database_model");
                $this->Database_model->upload_row($this->config->item("table_prefix") . "tips", $upload_array);
            } catch (Exception $e) {
                if ($e->getMessage() == "table_not_found") alert_swal_error(lang("table_not_found"), "account/helpthedev");
            }
            alert_swal_success(lang("successful_upload"), "account/helpthedev");
        }
        $this->load->view("templates/header");
        $this->load->view("account/helpthedev");
        $this->load->view("templates/footer");
    }
}
