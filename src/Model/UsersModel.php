<?php

declare(strict_types=1);

namespace App\Model;


use App\User;

class UsersModel
{
    private string $userFile;
    private array $usersArray;
    private array $newUsersArray;
    private array $userTableKeys;
    private User $newUser;


    function __construct($userTableKeys)
    {
        $this->userTableKeys = $userTableKeys;
        $this->retriveUsersFromFile();
    }

    function getUsers(): array
    {
        $this->retriveUsersFromFile();
        return $this->usersArray;
    }

    function saveUsers(): void
    {
        $json = json_encode($this->newUsersArray, JSON_PRETTY_PRINT);
        file_put_contents(__DIR__ . '/../../dataset/users.json', $json);
    }

    function deleteUser(int $userId): void
    {
        $this->retriveUsersFromFile();
        $newUsersArray = $this->usersArray;

        $this->newUsersArray = $this->removeElementById($newUsersArray, $userId);
        $this->saveUsers();
    }

    function addUser(User $userData): void
    {
        $this->retriveUsersFromFile();
        $newUser = array_combine($this->userTableKeys, $userData->getUserData());

        $newUsersArray = $this->usersArray;
        array_push($newUsersArray, $newUser);
        $this->newUsersArray = $newUsersArray;
        $this->saveUsers();
    }
    function retriveUsersFromFile(): void
    {
        $this->userFile = file_get_contents(__DIR__ . '/../../dataset/users.json');
        $this->usersArray = json_decode($this->userFile, true);
    }
    function removeElementById(array $array, int $id): array
    {
        return array_values(array_filter($array, function ($element) use ($id) {
            return $element['id'] !== $id;
        }));
    }
}
