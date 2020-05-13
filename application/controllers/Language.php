<?php

/**
 * Created by PhpStorm.
 * User: horva
 * Date: 2019.03.14.
 * Time: 19:26
 */

if (!defined('BASEPATH')) exit('Direct access allowed');

class Language extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        echo $this->session->userdata("site_lang") . " " . lang("hello");
    }

    function switch_lang($language = "")
    {
        $language = ($language != "") ? $language : $this->config->item("language");
        if (!in_array($language, $this->config->item("language_array"))) {
            $language = $this->config->item("language");
        };
        $this->session->set_userdata('site_lang', $language);
        redirect(base_url("account/profile"));
    }
    function backup()
    {
        foreach ($this->config->item("language_array") as $key => $value) {
            $this->lang->load($value, $value);
            $data_of_file = $this->lang->language;
            if (!$this->Language_model->get_lang_id_by_name($value)) {
                $this->Language_model->upload_lang_file_name($value);
            }
            foreach ($data_of_file as $data_key => $data_value) {
                if ($this->Language_model->get_value_by_line_and_lang_id($data_key, $this->Language_model->get_lang_id_by_name($value)) == null) {
                    echo $data_value."<br>";
                    $this->Language_model->upload_lang_file($data_key, $data_value, $this->Language_model->get_lang_id_by_name($value));
                }                
            }
        }
    }
}
