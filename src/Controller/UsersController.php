<?php

declare(strict_types=1);

namespace App\Controller;

use App\View;
use App\User;
use App\IdHandler;
use App\Model\UsersModel;

require_once("./src/View.php");
require_once("./src/Model/UsersModel.php");
require_once("./src/User.php");
require_once("./src/IdHandler.php");

class UsersController
{
    private array $request;
    private View $view;
    private array $newUserData;
    private User $newUser;
    private UsersModel $usersModel;
    public array $usersArray;
    private const DEFAULT_ACTION = "form";
    private const USER_KEYS = ["id", "name", "username", "email", "address", "phone", "company"];

    public function __construct(array $request)
    {
        $this->view = new View();
        $this->request = $request;
        $this->usersModel = new UsersModel(self::USER_KEYS);
        $this->getUsers();
    }
    public function run(): void
    {
        $data = $this->getRequestPost();
        $this->getUsers();
        $viewParams = [];
     
        if (!empty($this->request['post'])) {
            switch ($this->action()) {
                case "form":
                    $this->newUserData = array_values($this->getRequestPost());
                    $this->createNewUser();
                    $this->addNewUser();
                    break;
                case "delete":
                    $id = intval($this->getRequestPost()["id"]);
                    $this->deleteUser($id);
                    break;
                default:
                
                    return;
            }
        }
        $this->getUsers();
        $viewParams['usersArray'] = $this->usersArray;
        $this->view->render($viewParams);
    }
    public function action(): string
    {
        $data = $this->getRequestGet();
        return $data['action'] ?? self::DEFAULT_ACTION;
    }
    private function getRequestPost(): array
    {
        return $this->request['post'] ?? [];
    }
    private function getRequestGet(): array
    {
        return $this->request['get'] ?? [];
    }
    private function getUsers()
    {
        $this->usersArray = $this->usersModel->getUsers();
    }
    private function addNewUser()
    {
        $this->usersModel->addUser($this->newUser);
    }
    private function deleteUser(int $userId)
    {
        $this->usersModel->deleteUser($userId);
    }
    private function createNewUser(): void
    {
        $newId = IdHandler::createUniqId($this->usersArray);
        $this->newUser = new User($newId, ...$this->newUserData);
    }
};
