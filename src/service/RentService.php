<?php

namespace src\service;

use Exception;
use src\exception\UserNotFoundException;
use src\repository\CarRepository;
use src\repository\RentRepository;
use src\repository\UserRepository;

class RentService {

    /**
     * @throws UserNotFoundException
     * @throws Exception
     */
    public static function createRent($userId, $data): ?array
    {
        $user = UserRepository::getUserById($userId);
        if (!$user) {
            throw new UserNotFoundException();
        }
        $rentId = RentRepository::saveRent($userId, $data);
        return RentRepository::getRentById($rentId);
    }

    /**
     * @throws UserNotFoundException
     * @throws Exception
     */
    public static function getAllUserRents($userId): array
    {
        $user = UserRepository::getUserById($userId);
        if (!$user) {
            throw new UserNotFoundException();
        }
        return RentRepository::getAllUserRentsByUserId($userId);
    }

    /*  @throws Exception */
    public static function getAllRents(): array
    {
        return RentRepository::getAllRents();
    }

    /*  @throws Exception */
    public static function acceptRent($data): void
    {
        RentRepository::setRentStatusById($data['rentId'], 'принята');
    }

    /*  @throws Exception */
    public static function rejectRent($data): void
    {
        RentRepository::setRentStatusById($data['rentId'], 'отклонена');
    }
}