<?php

namespace src\controller;

use Exception;
use src\core\AuthContext;
use src\core\Request;
use src\core\Response;
use src\dto\RentRequest;
use src\exception\InvalidRentDataException;
use src\exception\UserNotFoundException;
use src\service\RentService;

class RentController {

    /**
     * @throws InvalidRentDataException
     * @throws UserNotFoundException
     */
    public function createRent(): void
    {
        $data = RentRequest::validateCreateData(Request::getJson());
        $authInfo = AuthContext::getAuthInfo();
        $rent = RentService::createRent($authInfo['userId'], $data);
        Response::json(['rent' => $rent], 201);
    }

    /**
     * @throws UserNotFoundException
     */
    public function getUserRents(): void
    {
        $authInfo = AuthContext::getAuthInfo();
        $rents = RentService::getAllUserRents($authInfo['userId'],);
        Response::json(['rents' => $rents], 200);
    }

    /* @throws InvalidRentDataException
     * @throws Exception
     */
    public function getAllRents(): void
    {
        $rents = RentService::getAllRents();
        Response::json(['rents' => $rents], 200);
    }

    /* @throws InvalidRentDataException
     * @throws Exception
     */
    public function acceptRent(): void
    {
        $data = RentRequest::validateRentIdData(Request::getJson());
        RentService::acceptRent($data);
        Response::json(['message' => 'Rent successfully accepted'], 200);
    }

    /* @throws InvalidRentDataException
     * @throws Exception
     */
    public function rejectRent(): void
    {
        $data = RentRequest::validateRentIdData(Request::getJson());
        RentService::rejectRent($data);
        Response::json(['message' => 'Rent successfully rejected'], 200);
    }

}