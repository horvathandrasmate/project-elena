<?php

function get_x_by_y($x, $y, $y_value, $TABLE)
{
    $CI =& get_instance();
    if ($x !== "*") {
        $CI->db->select($x);
        $result = $CI->db->get_where($TABLE, array($y => $y_value))->result_array();
       
        if (sizeof($result) > 0) {

            return $result[0][$x];
        };
    }else{
        return  $CI->db->get_where($TABLE, array($y => $y_value))->result_array();
    }
    return false;
}
