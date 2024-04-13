<?php

class Utility
{

    public function randomIDUser()
    {
        $characters = '0123456789';
        $length = 8;

        $userID = '';
        for ($i = 0; $i < $length; $i++) {
            $userID .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $userID;
    }

    // Random password
    function randomPassword($length = 8)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*?';
        $password = '';
        $charactersLength = strlen($characters);
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, $charactersLength - 1)];
        }

        return $password;
    }

    // Check Image File 

    public function checkImageFile($file)
    {
        $allowed = array('png', 'jpg', 'jpeg', 'gif');
        $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        if (!in_array($file_extension, $allowed)) {
            return false;
        } else {
            return true;
        }
    }
    // Check File
    public function checkFile($file)
    {
        $allowed = array('pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx');
        $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        if (!in_array($file_extension, $allowed)) {
            return false;
        } else {
            return true;
        }
    }
    // Anti XSS;

    public function checkXSS($data)
    {

        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }
}
