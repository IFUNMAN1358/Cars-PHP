<?php

namespace src\controller;

class TestController
{
    public function getTest() {
        header('Content-Type: application/json');
        echo json_encode("asdad");
    }

    public function postTest() {
        $data = json_decode(file_get_contents('php://input'), true);

        $name = isset($data['name']) ? $data['name'] : 'No name provided';

        header('Content-Type: application/json');
        echo json_encode(["name" => $name]);
    }
}