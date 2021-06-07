<?php


namespace App\Services;


use App\Services\ValueObjects\MembersObject;

interface KlaviyoApiService
{
	/**
	 * Add members to a list
	 *
	 * @param string $listId
	 * @param MembersObject $members
	 * @return array
	 */
	public function addMembersToList(string $listId, MembersObject $members): array;

	/**
	 * Create list
	 *
	 * @param string $listName
	 * @return array
	 */
	public function createList(string $listName): array;

	/**
	 * Delete member from list by email
	 *
	 * @param string $listId
	 * @param string $email
	 */
	public function deleteMemberFromListByEmail(string $listId, string $email): void;
}
