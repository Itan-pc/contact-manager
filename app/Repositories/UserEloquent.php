<?php


namespace App\Repositories;


use App\User as UserModel;

class UserEloquent implements UserRepository
{
	/**
	 * @var UserModel
	 */
	private $model;

	/**
	 * UserEloquent constructor.
	 *
	 * @param UserModel $model
	 */
	public function __construct(UserModel $model)
	{
		$this->model = $model;
	}

	/**
	 * Create user
	 *
	 * @param array $data
	 * @return UserModel
	 */
	public function create(array $data): UserModel
	{
	    return $this->model->newQuery()->create($data);
	}

	/**
	 * Update user
	 *
	 * @param UserModel $user
	 * @param array $data
	 * @return UserModel
	 */
	public function update(UserModel $user, array $data): UserModel
	{
		$user->fill($data);
		$user->save();

		return $user;
	}
}
