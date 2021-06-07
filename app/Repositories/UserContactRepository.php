<?php


namespace App\Repositories;


use App\UserContact as UserContactModel;

interface UserContactRepository
{
	/**
	 * Create user contact
	 *
	 * @param array $data
	 * @return UserContactModel
	 */
	public function create(array $data): UserContactModel;

    /**
     * Create or update
     *
     * @param array $attributes
     * @param array $data
     * @return UserContactModel
     */
    public function createOrUpdate(array $attributes, array $data): UserContactModel;

	/**
	 * Update user contact
	 *
	 * @param UserContactModel $userContact
	 * @param array $data
	 * @return UserContactModel
	 */
	public function update(UserContactModel $userContact, array $data): UserContactModel;

	/**
	 * Delete contact
	 *
	 * @param int $contactId
	 * @return mixed
	 */
	public function delete(int $contactId);
}
