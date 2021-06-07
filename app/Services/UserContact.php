<?php


namespace App\Services;


use App\Queries\UserContactQuery;
use App\Repositories\UserContactRepository;
use App\UserContact as UserContactModel;
use Illuminate\Database\Eloquent\Collection;

class UserContact implements UserContactService
{
	/**
	 * @var UserContactRepository
	 */
	private $repository;

	/**
	 * @var UserContactQuery
	 */
	private $query;

	/**
	 * UserContact constructor.
	 *
	 * @param UserContactRepository $userContactRepository
	 * @param UserContactQuery $query
	 */
	public function __construct(UserContactRepository $userContactRepository, UserContactQuery $query)
	{
		$this->repository = $userContactRepository;
		$this->query = $query;
	}

	/**
	 * Create user contact
	 *
	 * @param array $data
	 * @return UserContactModel
	 */
	public function create(array $data): UserContactModel
	{
		return $this->repository->create($data);
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
        return $this->repository->createOrUpdate($attributes, $data);
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
		return $this->repository->update($userContact, $data);
	}

	/**
	 * Delete user contact
	 *
	 * @param int $contactId
	 * @return mixed
	 */
	public function delete(int $contactId): bool
	{
		return $this->repository->delete($contactId);
	}

	/**
	 * Get all contacts
	 *
	 * @return Collection
	 */
	public function getAllContacts(): Collection
	{
		return $this->query->getAllContactsQuery()->get();
	}

	/**
	 * Get contacts by user id
	 *
	 * @param int $userId
	 * @return Collection
	 */
	public function getContactsByUserId(int $userId): Collection
	{
		return $this->query->getContactsByUserIdQuery($userId)->get();
	}

	/**
	 * Get contact by id
	 *
	 * @param int $contactId
	 * @return UserContactModel
	 */
	public function getContactById(int $contactId): UserContactModel
	{
		return $this->query->getContactByIdQuery($contactId)->firstOrFail();
	}
}
