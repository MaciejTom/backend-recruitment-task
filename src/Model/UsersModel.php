<?php

declare(strict_types=1);

namespace App\Model;

use App\User;

class UsersModel
{
    private array $usersArray;
    private array $newUsersArray;
    private array $userTableKeys;
    private const USERS_FILE_PATH = __DIR__ . '/../../dataset/users.json';

    public function __construct(array $userTableKeys)
    {
        $this->userTableKeys = $userTableKeys;
        $this->retrieveUsersFromFile();
    }

    public function getUsers(): array
    {
        $this->retrieveUsersFromFile();
        return $this->usersArray;
    }

    public function saveUsers(): void
    {
        try {
            $json = json_encode($this->newUsersArray, JSON_PRETTY_PRINT);
            if ($json === false) {
                throw new \RuntimeException('Failed to encode users data to JSON.');
            }

            $result = file_put_contents(self::USERS_FILE_PATH, $json);
            if ($result === false) {
                throw new \RuntimeException('Failed to save users data to file.');
            }
        } catch (\RuntimeException $e) {
            echo 'Exception occured: ' . $e->getMessage();
        }
    }

    public function deleteUser(int $userId): void
    {
        $this->retrieveUsersFromFile();
        $newUsersArray = $this->usersArray;

        $this->newUsersArray = $this->removeElementById($newUsersArray, $userId);
        $this->saveUsers();
    }

    public function addUser(User $userData): void
    {
        $this->retrieveUsersFromFile();
        $newUser = array_combine($this->userTableKeys, $userData->getUserData());

        $newUsersArray = $this->usersArray;
        $newUsersArray[] = $newUser;
        $this->newUsersArray = $newUsersArray;
        $this->saveUsers();
    }

    private function retrieveUsersFromFile(): void
    {
        try {
            $json = file_get_contents(self::USERS_FILE_PATH);
            if ($json === false) {
                throw new \RuntimeException('Failed to read users data from file.');
            }

            $this->usersArray = json_decode($json, true);
            if ($this->usersArray === null) {
                throw new \RuntimeException('Failed to decode users data from JSON.');
            }
        } catch (\RuntimeException $e) {
            echo 'Exception occured: ' . $e->getMessage();
            $this->usersArray = [];
        }
    }

    private function removeElementById(array $array, int $id): array
    {
        return array_values(array_filter($array, function ($element) use ($id) {
            return $element['id'] !== $id;
        }));
    }
}
