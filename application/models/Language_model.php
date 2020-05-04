<?php

if (!defined('BASEPATH')) exit('Direct access allowed');

class Language_model extends CI_Model
{
    public static $TABLE_LANGS = "langs";
    public static $TABLE_LANGS_NAMES = "langs_names";
    function __construct()
    {
        self::$TABLE_LANGS = $this->config->item("table_prefix") . self::$TABLE_LANGS;
        self::$TABLE_LANGS_NAMES = $this->config->item("table_prefix") . self::$TABLE_LANGS_NAMES;

        if ($this->session->userdata("site_lang") !== null) {
            $this->lang->load($this->session->userdata("site_lang"), $this->session->userdata("site_lang"));
        } else {
            $this->lang->load($this->config->item("language"), $this->config->item("language"));
        }
    } 
    public function get_lang_id_by_name($lang_name)
    {
        $this->db->select("id");
        $result = $this->db->get_where(self::$TABLE_LANGS_NAMES, array("lang_name" => $lang_name))->result_array();
        if (sizeof($result) > 0) {
            return $result[0]['id'];
        };
        return false;
    }
    public function get_value_by_line_and_lang_id($line, $lang_id)
    {
       $this->db->select("value");
        
        $this->db->where("lang_id", $lang_id);
        $this->db->where("line", $line);
        
       $result = $this->db->get(self::$TABLE_LANGS)->result_array();
       
        if (sizeof($result) > 0) {
           
            return $result[0]['value'];
             
        };
        return false;
        
    }
    
    
    public function upload_lang_file($line, $value, $lang_id)
    {
        $data = array(
            "lang_id" => $lang_id,
            "line" => $line,
            "value" => $value
        );
        $this->db->insert(self::$TABLE_LANGS, $data);
        return true;
    }
    public function upload_lang_file_name($file_name)
    {
        $data = array(
            "lang_name" => $file_name,
        );
 $this->db->insert(self::$TABLE_LANGS_NAMES, $data);

        return true;
    }
}
