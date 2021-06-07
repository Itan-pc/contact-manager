<?php


namespace App\Repositories;


use App\UserContact as UserContactModel;

class UserContactEloquent implements UserContactRepository
{
	/**
	 * @var UserContactModel
	 */
	private $model;

	/**
	 * UserContactEloquent constructor.
	 *
	 * @param UserContactModel $model
	 */
	public function __construct(UserContactModel $model)
	{
		$this->model = $model;
	}

	/**
	 * Create user contact
	 *
	 * @param array $data
	 * @return UserContactModel
	 */
	public function create(array $data): UserContactModel
	{
        return $this->model->newQuery()->create($data);
	}

    /**
     * Create or update
     *
     * @param array $attributes
     * @param array $data
     * @return UserContactModel
     */
	public function createOrUpdate(array $attributes, array $data): UserContactModel
    {
        return $this->model->newQuery()->updateOrCreate($attributes, $data);
    }

	/**
	 * Update user contact
	 *
	 * @param UserContactModel $userContact
	 * @param array $data
	 * @return UserContactModel
	 */
	public function update(UserContactModel $userContact, array $data): UserContactModel
	{
		$userContact->fill($data);
		$userContact->save();

		return $userContact;
	}

	/**
	 * Delete contact
	 *
	 * @param int $contactId
	 * @return mixed
	 */
	public function delete(int $contactId)
	{
		return $this->model->newQuery()->where('id', $contactId)->delete();
	}
}
