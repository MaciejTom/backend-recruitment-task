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
    private UsersModel $usersModel;
    private const DEFAULT_ACTION = "form";
    private const USER_KEYS = ["id", "name", "username", "email", "address", "phone", "company"];
    private const TABLE_HEADERS = ["Name", "Username", "Email", "Address", "Phone", "Company"];
    public function __construct(array $request)
    {
        $this->view = new View();
        $this->request = $request;
        $this->usersModel = new UsersModel(self::USER_KEYS);
    }

    public function run(): void
    {
        $viewParams = [];

        if (!empty($this->request['post'])) {
            $this->handlePostRequest();
        }

        $viewParams['usersArray'] = $this->getUsers();
        $viewParams['tableHeaders'] = self::TABLE_HEADERS;
        $this->view->render($viewParams);
    }

    private function handlePostRequest(): void
    {
        $action = $this->getAction();

        switch ($action) {
            case "form":
                $this->handleFormAction();
                break;
            case "delete":
                $this->handleDeleteAction();
                break;
            default:
                $unknownAction = $this->getAction();
                error_log("Unkknown action " . $unknownAction);
                break;
        }
        header('Location: /');
        exit();
    }

    private function handleFormAction(): void
    {
        $newUserData = array_values($this->getRequestPost());
        $newId = IdHandler::createUniqId($this->getUsers());
        $newUser = new User($newId, ...$newUserData);
        $this->usersModel->addUser($newUser);
    }

    private function handleDeleteAction(): void
    {
        $id = intval($this->getRequestPost()["id"]);
        $this->usersModel->deleteUser($id);
    }

    private function getAction(): string
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

    private function getUsers(): array
    {
        return $this->usersModel->getUsers();
    }
}
