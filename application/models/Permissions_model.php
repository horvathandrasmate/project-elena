<?php



class Permissions_model extends CI_Model
{
    public static $PERMISSIONS_TABLE = "permissions";
    public static $PERMISSIONS_NAMES_TABLE = "permissions_names";
    public static $UGROUP_TABLE = "ugroups";
    public static $UGROUP_NAMES_TABLE = "ugroups_names";
    function __construct()
    {
        self::$PERMISSIONS_TABLE = $this->config->item('table_prefix') . self::$PERMISSIONS_TABLE;
        self::$PERMISSIONS_NAMES_TABLE = $this->config->item('table_prefix') . self::$PERMISSIONS_NAMES_TABLE;
        self::$UGROUP_TABLE = $this->config->item('table_prefix') . self::$UGROUP_TABLE;
        self::$UGROUP_NAMES_TABLE = $this->config->item('table_prefix') . self::$UGROUP_NAMES_TABLE;
    }
    function has_permission($permission_name, $user_id)
    {

        try {
            //get the ugroup id by userid
            $ugroup_id = get_x_by_y("id", "user_id", $user_id, self::$UGROUP_TABLE);
            //get the row by permission id
            $permission_id = get_x_by_y("id", "permission_name", $permission_name, self::$PERMISSIONS_NAMES_TABLE);
            if (sizeof(get_x_by_y("*", "permission_id", $permission_id, self::$PERMISSIONS_TABLE)) > 0) {
                return true;
            } else {

                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }
    function upload_permission($permission_name)
    {
        if (sizeof(get_x_by_y("*", "permission_name", $permission_name, self::$PERMISSIONS_NAMES_TABLE)) != 0) {
            throw new Exception("used_permission_name");
        }


        $array = array(
            "permission_name" => $permission_name
        );
        return $this->db->insert(self::$PERMISSIONS_NAMES_TABLE, $array);
    }
    function get_groups()
    {

        $this->db->select("ugroup_nice_name");
        $result = $this->db->get(self::$UGROUP_NAMES_TABLE)->result_array();
        if (sizeof($result) > 0) {
            return $result;
        } else {
            return false;
        }
    }
    function delete_ugroup_for_user($user_id){
        $this->db->where("user_id", $user_id);
        return $this->db->delete(self::$UGROUP_TABLE);
    }
    function change_ugroup_for_user($ugroup_nice_name, $username)
    {
        $this->load->model("Account_model");
        $ugroup_id = get_x_by_y("id", "ugroup_nice_name", $ugroup_nice_name, self::$UGROUP_NAMES_TABLE);
        $user_id = $this->Account_model->get_user_id_by_username($username);
        if (sizeof($ugroup_id) > 0) {
            if (sizeof($user_id) > 0) {
                if(sizeof(get_x_by_y("id", "user_id", $user_id, self::$UGROUP_TABLE))>0){
                    self::delete_ugroup_for_user($user_id);
                }
                $array = array(
                    "ugroup_id" => $ugroup_id,
                    "user_id" => $user_id
                );
                $this->db->insert(self::$UGROUP_TABLE, $array);
                $update_array = array(
                    "ugroup" => get_x_by_y("ugroup_name", "id", $ugroup_id, self::$UGROUP_NAMES_TABLE)
                );
                $this->Account_model->update_user($user_id, $update_array);
            }
        }
    }
}
