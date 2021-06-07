<?php


namespace App\Queries;


use App\UserContact;
use Illuminate\Database\Eloquent\Builder;

class UserContactQuery
{
	/**
	 * Get base query
	 *
	 * @return Builder
	 */
	protected function getBaseQuery(): Builder
	{
		return UserContact::query();
	}

	/**
	 * Get all contacts query
	 *
	 * @return Builder
	 */
	public function getAllContactsQuery(): Builder
	{
		return $this->getBaseQuery();
	}

	/**
	 * Get contacts by user id query
	 *
	 * @param int $userId
	 * @return Builder
	 */
	public function getContactsByUserIdQuery(int $userId): Builder
	{
		$query = $this->getBaseQuery();

		$query->where('user_id', $userId);

		return $query;
	}

	/**
	 * Get contact by id query
	 *
	 * @param int $contactId
	 * @return Builder
	 */
	public function getContactByIdQuery(int $contactId): Builder
	{
		$query = $this->getBaseQuery();

		$query->where('id', $contactId);

		return $query;
	}
}