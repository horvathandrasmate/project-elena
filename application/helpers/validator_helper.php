<?php


    function is_valid_date($date, $format = 'Y-m-d')
    {
        $tempDate = explode('-', $date);
        // checkdate(month, day, year)
        return checkdate($tempDate[1], $tempDate[2], $tempDate[0]);
    }
    function is_alphanumeric($string)
    {
        return !preg_match('/[^a-z_\-0-9\á\í\ű\ő\ü\ö\ú\ó\é ]/i', $string);
    }
    function is_alphanumeric_or_percentage($string)
    {
        return !preg_match('/[^a-z_\-0-9\á\í\ű\ő\ü\ö\ú\ó\é %]/i', $string);
    }
    function encrypt($text)
    {
        return hash("sha256", $text);
    }
    function is_valid_email($email)
    {
        if (trim($email) === "") return false;
        return (filter_var($email, FILTER_VALIDATE_EMAIL));
    }

