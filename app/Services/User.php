<?php


namespace App\Services;


use App\DTO\UpdateUserDTO;
use App\Repositories\UserRepository;
use App\User as UserModel;
use Illuminate\Contracts\Hashing\Hasher;

class User implements UserService
{
	/**
	 * @var UserRepository
	 */
	private $repository;

	/**
	 * @var Hasher
	 */
	private $hasher;

	/**
	 * User constructor.
	 *
	 * @param Hasher $hasher
	 * @param UserRepository $repository
	 */
	public function __construct(Hasher $hasher, UserRepository $repository)
	{
		$this->repository = $repository;
		$this->hasher = $hasher;
	}

	/**
	 * Update user
	 *
	 * @param UserModel $user
	 * @param UpdateUserDTO $updateUserDTO
	 * @return UserModel
	 */
	public function update(UserModel $user, UpdateUserDTO $updateUserDTO): UserModel
	{
		if ($updateUserDTO->getPassword()) {
			$updateUserDTO->setPassword($this->hasher->make($updateUserDTO->getPassword()));
		}

		return $this->repository->update($user, $updateUserDTO->toArray());
	}
}