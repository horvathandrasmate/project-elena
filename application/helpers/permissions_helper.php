<?php
$CI =& get_instance();

function has_permission($permission_name,$user_id = ""){
    $CI =& get_instance();
    if($user_id == ""){
        $CI->load->model("Account_model");
        $userid = $CI->Account_model->get_id_by_username($CI->session->userdata("username"));
    }
    $CI->load->model("Permissions_model");
    
    return $CI->Permissions_model->has_permission($permission_name, $user_id);
   
    
}
?>