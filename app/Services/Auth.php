<?php


namespace App\Services;


use App\DTO\CreateUserDTO;
use App\Repositories\UserRepository;
use App\User as UserModel;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Hashing\Hasher;

class Auth implements AuthService
{
	/**
	 * @var Hasher
	 */
	private $hasher;

	/**
	 * @var UserRepository
	 */
	private $userRepository;

	/**
	 * @var StatefulGuard
	 */
	private $auth;

	/**
	 * User constructor.
	 *
	 * @param Hasher $hasher
	 * @param UserRepository $userRepository
	 * @param StatefulGuard $auth
	 */
	public function __construct(
		Hasher $hasher,
		UserRepository $userRepository,
		StatefulGuard $auth
	)
	{
		$this->hasher = $hasher;
		$this->userRepository = $userRepository;
		$this->auth = $auth;
	}

	/**
	 * Register user
	 *
	 * @param CreateUserDTO $createUserDTO
	 * @return UserModel
	 */
	public function register(CreateUserDTO $createUserDTO): UserModel
	{
		$password = $this->hasher->make($createUserDTO->getPassword());

		$createUserDTO->setPassword($password);

		return $this->userRepository->create($createUserDTO->toArray());
	}

	/**
	 * Login user
	 *
	 * @param array $credentials
	 * @return UserModel|null
	 */
	public function login(array $credentials): ?UserModel
	{
		if (!$this->auth->attempt($credentials)) {
			return null;
		}

		/** @var UserModel $user */
		$user = $this->auth->user();

		return $user;
	}

	/**
	 * Logout user
	 *
	 * @return bool
	 */
	public function logout(): bool
	{
		return $this->auth->check() && $this->auth->user()->token()->revoke();
	}
}