<?php

namespace App\DTO;

use App\Http\Requests\RegisterUser;

class UserDTO
{
  public readonly string $email;
  public readonly string $username;
  public readonly string $lastName;
  public readonly string $firstName;
  public readonly ?string $middleName;
  public readonly ?string $password;

  public function setEmail($email)
  {
    $this->email = $email;
  }

  public function setUsername($username)
  {
    $this->username = $username;
  }

  public function setFirstName($firstName)
  {
    $this->firstName =  $firstName;
  }

  public function setLastName($lastName)
  {
    $this->lastName =  $lastName;
  }

  public function setMiddleName($middleName)
  {
    $this->middleName = $middleName;
  }

  public function setPassword($password)
  {
    $this->password = $password;
  }

  public function fromRegisterApi(RegisterUser $request)
  {
    $userDTO = new self;
    $userDTO->setEmail($request->email);
    $userDTO->setUsername($request->username);
    $userDTO->setLastName($request->last_name);
    $userDTO->setFirstName($request->first_name);
    $userDTO->setMiddleName($request->middle_name);
    $userDTO->setPassword($request->password);

    return $userDTO;
  }
}