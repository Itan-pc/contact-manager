<?php


namespace App\Services\ValueObjects;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class MembersObject
{
	/**
	 * @var Collection
	 */
	private $members;

	/**
	 * Validate member rules
	 *
	 * @var array
	 */
	protected $validateMemberRules = [
		'email' => 'required_without:phone_number|email',
		'phone_number' => 'required_without:email|string|phone:AUTO,UA'
	];

	/**
	 * MembersObject constructor.
	 */
	public function __construct()
	{
		$this->members = new Collection();
	}

	/**
	 * Add member
	 *
	 * @param array $member
	 * @return MembersObject
	 * @throws ValidationException
	 */
	public function addMember(array $member): self
	{
		$this->validateMember($member);

		$this->members->add($member);

		return $this;
	}

	/**
	 * Add members
	 *
	 * @param array $members
	 * @return MembersObject
	 * @throws ValidationException
	 */
	public function addMembers(array $members): self
	{
		foreach ($members as $member) {
			if (is_array($member)) {
				$this->validateMember($member);
			}

			$this->members->add($member);
		}

		return $this;
	}

	/**
	 * Get all members
	 *
	 * @return array
	 */
	public function getAllMembers(): array
	{
		return $this->members->all();
	}

	/**
	 * Validate member
	 *
	 * @param array $member
	 * @throws ValidationException
	 */
	public function validateMember(array $member): void
	{
		Validator::make($member, $this->validateMemberRules)->validate();
	}
}
