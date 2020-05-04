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
    function manage(){
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


        if (NULL !== $this->input->post('register')) {
            $nice_user_name = $this->input->post("nice_user_name");
            $username = $this->input->post("username");
            $password = $this->input->post("password");
            $repeat_password = $this->input->post("repeat_password");
            $email = $this->input->post("email");

            if ($password != $repeat_password) {
                $this->load->view("templates/header");
                alert_swal_error(lang("passwords_dont_match"));
            }
            try {
                $this->Account_model->register($username, $nice_user_name, $password, $email);
            } catch (Exception $e) {

                if ($e->getMessage() == "not_valid_username") alert_swal_error(lang("invalid_username"), "account/login");
                if ($e->getMessage() == "not_valid_nice_user_name") alert_swal_error(lang("invalid_nice_user_name"), "account/login");
                if ($e->getMessage() == "not_valid_email") alert_swal_error(lang("invalid_email"), "account/login");
                if ($e->getMessage() == "username_match") alert_swal_error(lang("username_match"), "account/login");
                if ($e->getMessage() == "email_match") alert_swal_error(lang("email_match"), "account/login");
            }
            alert_swal_success(lang("successful_registration"), "account/login");
        } elseif (NULL !== $this->input->post('login')) {

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
}
