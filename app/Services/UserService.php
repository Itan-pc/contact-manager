<?php


namespace App\Services;


use App\DTO\UpdateUserDTO;
use App\User as UserModel;

interface UserService
{
	/**
	 * Update user
	 *
	 * @param UserModel $user
	 * @param UpdateUserDTO $updateUserDTO
	 * @return UserModel
	 */
	public function update(UserModel $user, UpdateUserDTO $updateUserDTO): UserModel;
}