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

    // Check File Upload
    public function checkFileUpload($file)
    {
        $allowedExtensions = array("doc", "docx", "pdf");
        $allowedMimeTypes = array(
            "application/msword",
            "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
            "application/pdf"
        );

        // Kiểm tra xem có lỗi nào xảy ra khi tải lên không
        if ($file["error"] !== UPLOAD_ERR_OK) {
            return "Không có file được tải lên!";
        }

        // Lấy phần mở rộng của tệp
        $extension = pathinfo($file["name"], PATHINFO_EXTENSION);

        // Kiểm tra phần mở rộng và kiểu MIME của tệp
        if (!in_array($extension, $allowedExtensions) || !in_array($file["type"], $allowedMimeTypes)) {
            return "File tải lên không hợp lệ!";
        }

        // Kiểm tra kích thước của tệp
        if ($file["size"] > 10000000) { // Giới hạn kích thước 1MB
            return "Kích thước file không quá 10MB.";
        }

        // Nếu tất cả các kiểm tra đều đúng, trả về true (không có lỗi)
        return true;
    }


    // Anti XSS;

    public static function checkAtackXSS($input)
    {
        // Kiểm tra xem đầu vào có phải là một mảng hay không
        if (is_array($input)) {

            foreach ($input as $key => $value) {


                $input[$key] = self::checkAtackXSS($value);
            }
        } else {
            $input = trim($input);
            $input = htmlspecialchars(strip_tags($input), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        }
        return $input;
    }



    //Anti CSRF

    //Check Anti CSRF
    public function checkToken($user_token, $session_token)
    {
        if ($user_token !== $session_token || !isset($session_token)) {
            return false;
        } else {
            return true;
        }
    }

    // Destroy session token
    public function destroySessionToken()
    {
        unset($_SESSION['session_token']);
    }

    // Generate session token
    public function generateSessionToken()
    {
        if (isset($_SESSION['session_token'])) {
            $this->destroySessionToken();
        }
        $_SESSION['session_token'] = md5(uniqid());
        return $_SESSION['session_token'];
    }
}
