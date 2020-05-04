<?php

function require_login()
{
    $CI =& get_instance();
    if (!$CI->session->userdata('logged_in')) {
        alert_swal_error("Login required!", "account/login");
        // redirect(base_url()."account/login");
        die();

    } else {
        return true;
    }
}