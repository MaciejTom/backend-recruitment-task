<?php

declare(strict_types=1);

namespace App;


class User
{
    private $id;
    private $name;
    private $username;
    private $email;
    private $address;
    private $phone;
    private $company;

    public function __construct($id, $name, $username, $email, $address, $phone, $company)
    {
        $this->id = $id;
        $this->name = $name;
        $this->username = $username;
        $this->email = $email;
        $this->address = $address;
        $this->phone = $phone;
        $this->company = $company;
    }
    function getUserData(): array
    {
        return [$this->id, $this->name, $this->username, $this->email, $this->address, $this->phone, $this->company];
    }
}
