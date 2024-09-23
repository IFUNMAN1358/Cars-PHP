<?php

namespace src\core;

class Request {

    public static function getJson() {
        return json_decode(file_get_contents('php://input'), true);
    }

    public static function getFormData(): array
    {
        $formData = [];

        foreach ($_POST as $key => $value) {
            $formData[$key] = $value;
        }

        foreach ($_FILES as $key => $file) {
            if (isset($file['tmp_name']) && is_uploaded_file($file['tmp_name'])) {
                $formData[$key] = $file;
            }
        }
        return $formData;
    }

    public static function getAuthorizationHeader(): ?string
    {
        if (isset($_SERVER['Authorization'])) {
            return trim($_SERVER['Authorization']);
        } elseif (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            return trim($_SERVER['HTTP_AUTHORIZATION']);
        }
        return null;
    }

}