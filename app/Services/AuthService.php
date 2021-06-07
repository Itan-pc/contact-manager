<?php


namespace App\Services;


use App\DTO\CreateUserDTO;
use App\User as UserModel;

interface AuthService
{
	/**
	 * Register user
	 *
	 * @param CreateUserDTO $createUserDTO
	 * @return UserModel
	 */
	public function register(CreateUserDTO $createUserDTO): UserModel;

	/**
	 * Login user
	 *
	 * @param array $credentials
	 * @return UserModel|null
	 */
	public function login(array $credentials): ?UserModel;

	/**
	 * Logout user
	 *
	 * @return bool
	 */
	public function logout(): bool;
}