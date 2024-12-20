<?php

namespace App\Repositories;

use App\DTO\UserDTO;
use App\Models\User;

class UserRepository
{
  public function __construct(private User $userModel) { }

  public function storeUser(UserDTO $userDTO)
  {
    
  }
}