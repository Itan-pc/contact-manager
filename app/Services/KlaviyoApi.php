<?php


namespace App\Services;


use App\Services\ValueObjects\MembersObject;
use Illuminate\Support\Facades\Http;

class KlaviyoApi implements KlaviyoApiService
{
	/**
	 * @var string
	 */
	private $apiKey;

	/**
	 * @var string
	 */
	private $apiLink;

	/**
	 * @var Http
	 */
	private $client;

	/**
	 * KlaviyoApi constructor.
	 *
	 * @param Http $client
	 * @param string $apiLink
	 * @param string $apiKey
	 */
	public function __construct(Http $client, string $apiLink, string $apiKey)
	{
		$this->client = $client;
		$this->apiLink = trim($apiLink, '/');
		$this->apiKey = $apiKey;
	}

	/**
	 * Add members to a list
	 *
	 * @param string $listId
	 * @param MembersObject $members
	 * @return array
	 */
	public function addMembersToList(string $listId, MembersObject $members): array
	{
		$request = $this->client::post(
			$this->generateUrl("list/$listId/members"),
			[
				'profiles' => $members->getAllMembers()
			]
		);

		return $request->json();
	}

	/**
	 * Create list
	 *
	 * @param string $listName
	 * @return array
	 */
	public function createList(string $listName): array
	{
		$request = $this->client::post(
			$this->generateUrl('lists'),
			[
				'list_name' => $listName
			]
		);

		return $request->json();
	}

	/**
	 * Delete member from list by email
	 *
	 * @param string $listId
	 * @param string $email
	 */
	public function deleteMemberFromListByEmail(string $listId, string $email): void
	{
		$emails[] = $email;

		$this->client::delete(
			$this->generateUrl("list/$listId/members"),
			[
				'emails' => $emails
			]
		);
	}

	/**
	 * Generate url
	 *
	 * @param string $uri
	 * @return string
	 */
	private function generateUrl(string $uri): string
	{
		return $this->apiLink . '/' . trim($uri, '/') . '?api_key=' . $this->apiKey;
	}
}
