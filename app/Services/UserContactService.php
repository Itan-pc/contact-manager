<?php


namespace App\Services;


use App\UserContact as UserContactModel;
use Illuminate\Database\Eloquent\Collection;

interface UserContactService
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

	/**
	 * Get all contacts
	 *
	 * @return Collection
	 */
	public function getAllContacts(): Collection;

	/**
	 * Get contacts by user id
	 *
	 * @param int $userId
	 * @return Collection
	 */
	public function getContactsByUserId(int $userId): Collection;

	/**
	 * Get contact by id
	 *
	 * @param int $contactId
	 * @return UserContactModel
	 */
	public function getContactById(int $contactId): UserContactModel;
}
