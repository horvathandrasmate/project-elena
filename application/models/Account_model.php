<?php


/**
 * @property Permissions_model Permissions_model
 */
class Account_model extends CI_Model
{

    public static $TABLE_NAME = "users";

    public static $username = "";
    public static $email = "";
    public static $nice_user_name = "";
    public static $logged_in = false;

    function __construct()
    {
        parent::__construct();
        self::$TABLE_NAME = $this->config->item('table_prefix') . self::$TABLE_NAME;
    }

    function index()
    {
        redirect(base_url('account/login'));
    }
    function get_table_name(){
        return self::$TABLE_NAME;
    }
    /**
     * @param $username
     * @param $nice_user_name
     */
    function login($username, $password)
    {


        $result = $this->db->get_where(self::$TABLE_NAME, array("username" => $username))->result_array();


        if (empty($result[0]['username'])) {
            throw new Exception("unknown_username");
        }

        $real_password = $result[0]['password'];

        if (encrypt($password) !== $real_password) {
            throw new Exception('password_dont_match');
        }

        $this->session->set_userdata('username', "$username");
        $this->session->set_userdata('user_id', $this->get_id_by_username($username));
        $this->session->set_userdata('logged_in', true);
        $this->session->set_userdata('email', $this->get_email_by_username($username));
        $this->session->set_userdata('nice_user_name', $this->get_nice_user_name_by_username($username));

        self::$nice_user_name = $this->get_nice_user_name_by_username($username);
        self::$username = $username;
        self::$email = $this->get_email_by_username($username);
        self::$logged_in = true;
    }

    function get_nice_user_name_by_username($username)
    {
        $result = $this->db->get_where(self::$TABLE_NAME, array('username' => $username))->result_array();
        if (!empty($result)) {
            return $result[0]['nice_user_name'];
        } else {
            return "";
        }
    }
    function update_user($user_id,array $array){
        return $this->db->update(self::$TABLE_NAME, $array, array("id" => $user_id));
    }
    function get_user_id_by_username($username){
        return get_x_by_y("id", "username", $username, self::$TABLE_NAME);
    }
    function get_username_by_nice_user_name($nice_user_name)
    {
        $result = $this->db->get_where(self::$TABLE_NAME, array('nice_user_name' => $nice_user_name))->result_array();
        if (!empty($result)) {
            return $result[0]['username'];
        } else {
            return "";
        }
    }

    function get_email_by_username($username)
    {
        $result = $this->db->get_where(self::$TABLE_NAME, array('username' => $username))->result_array();
        if (!empty($result)) {
            return $result[0]['email'];
        } else {
            return "";
        }
    }

    function get_users()
    {
        $this->load->model("Database_model");
        return $this->Database_model->get_table(self::$TABLE_NAME);
    }
    function get_usernames()
    {
        $this->db->select("username");
        return $this->db->get(self::$TABLE_NAME)->result_array();
    }
    function get_nice_user_name_by_id($id)
    {
        $result = $this->db->get_where(self::$TABLE_NAME, array('id' => $id))->result_array();
        if (!empty($result)) {
            return $result[0]['nice_user_name'];
        } else {
            return "";
        }
    }

    function get_partner_id_by_username($username)
    {
        $result = $this->db->get_where(self::$TABLE_NAME, array('username' => $username))->result_array();
        if (!empty($result)) {
            return $result[0]['partner_id'];
        } else {
            return "";
        }
    }

    function get_id_by_username($username)
    {
        $this->load->database();
        $result = $this->db->get_where(self::$TABLE_NAME, array('username' => $username))->result_array();
        if (!empty($result)) {
            return $result[0]['id'];
        } else {
            return "";
        }
    }

    function manage_partner($partner_id)
    {
        if (has_permission($partner_id . "_partner")) {
            throw new Exception("actual_partner");
        } else
            try {
                if ($this->Permissions_model->has_permission($partner_id, "admin")) {
                    throw new Exception("admin_profile");
                } else if ($this->session->userdata("user_id") === $partner_id) {
                    throw new Exception("same_profile");
                } else if (!empty($this->get_nice_user_name_by_id($partner_id))) {

                    $actual_partner = $this->session->userdata("partner_id");
                    echo $this->session->userdata("user_id") . " -> -> ";
                    echo $this->Permissions_model->get_id_by_permission_name($actual_partner . "_partner")[0];

                    echo "Törlés:" . $actual_partner . "_partner" . $this->Permissions_model->remove_permission($this->session->userdata("user_id"), $this->Permissions_model->get_id_by_permission_name($actual_partner . "_partner")[0]);

                    $this->Permissions_model->give_permission($this->session->userdata("user_id"), $this->Permissions_model->get_id_by_permission_name($partner_id . "_partner")[0]);

                    try {
                        $this->modify_partner($this->session->userdata("user_id"), $partner_id);
                    } catch (Exception $e) {
                        die($e->getMessage());
                    }
                }
            } catch (Exception $e) {
                die($e->getMessage());
            }
    }


    /**
     * @param $username
     * @param $nice_user_name
     * @param $password
     * @param $email
     * @throws Exception
     */
    function modify_partner($user_id, $partner_id)
    {
        $this->db->set("partner_id", $partner_id);
        $this->db->where("id", $user_id);
        $this->db->update(self::$TABLE_NAME);
        $this->session->set_userdata("partner_id", $partner_id);
    }
    function register($username, $nice_user_name, $password, $email)
    {
        $this->load->database();
        if (!is_alphanumeric($username)) {
            throw new Exception("not_valid_username");
        }
        $this->db->select('username');
        $result_array = $this->db->get_where(self::$TABLE_NAME, array("username" => $username))->result_array();

        if (!empty($result_array)) {

            throw new Exception("username_match");
        }
        $result_array = $this->db->get_where(self::$TABLE_NAME, array("email" => $email))->result_array();

        if (!empty($result_array)) {
            throw new Exception("email_match");
        }

        if (!is_alphanumeric($nice_user_name)) {

            throw new Exception("not_valid_nice_user_name");
        }
        $result_array = $this->db->get_where(self::$TABLE_NAME, array("email" => $email))->result_array();
        if (!is_valid_email($email) || !empty($result_array)) {

            throw new Exception("not_valid_email");
        }

        $this->db->insert(self::$TABLE_NAME, array("username" => $username, "nice_user_name" => $nice_user_name, "email" => $email, "password" => encrypt($password)));
        // $this->db->insert(self::$LOG_TABLE_NAME, array('username' => $username, "date" => date('Y-m-d h:i:s'), "type" => 'register'));

    }

    function get_profile($username)
    {
        $this->db->limit(1);
        $result_array = $this->db->get_where(self::$TABLE_NAME, array("username" => $username))->result_array();
        if (sizeof($result_array) > 0) {
            return $result_array[0];
        } else {
            return false;
        }
    }

    
    function logout()
    {
        if ($this->session->userdata('logged_in')) {
            $this->session->sess_destroy();
            self::$nice_user_name = "";
            self::$username = "";
            self::$logged_in = false;
        }
    }
}
