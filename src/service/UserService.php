<?php

namespace src\service;

use src\dto\user\UserDto;
use src\exception\InvalidUserDataException;
use src\model\User;
use src\repository\UserRepository;
use Exception;

class UserService {

    private $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws InvalidUserDataException
     * @throws Exception
     */
    public function createUser($data) {

        if (!UserDto::validateRegisterData($data)) {
            throw new InvalidUserDataException();
        }

        $user = new User(
            $data['firstName'],
            $data['lastName'],
            $data['phone'],
            $data['email'],
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT)
        );

        return $this->userRepository->saveUser($user);
    }
}