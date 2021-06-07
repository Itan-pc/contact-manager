<?php


namespace App\Repositories;


use App\User as UserModel;

interface UserRepository
{
	/**
	 * Create user
	 *
	 * @param array $data
	 * @return UserModel
	 */
	public function create(array $data): UserModel;

	/**
	 * Update user
	 *
	 * @param UserModel $user
	 * @param array $data
	 * @return UserModel
	 */
	public function update(UserModel $user, array $data): UserModel;
}