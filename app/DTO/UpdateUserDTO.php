<?php


namespace App\DTO;


use Illuminate\Contracts\Support\Arrayable;

class UpdateUserDTO implements Arrayable
{
	/**
	 * User name
	 *
	 * @var string
	 */
	private $name;

	/**
	 * User password
	 *
	 * @var string
	 */
	private $password;

	/**
	 * User email
	 *
	 * @var string
	 */
	private $email;

	/**
	 * User list id
	 *
	 * @var string
	 */
	private $listId;

	/**
	 * Set user password
	 *
	 * @param string $name
	 * @return self
	 */
	public function setName(string $name): self
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * Set user password
	 *
	 * @param string $password
	 * @return self
	 */
	public function setPassword(string $password): self
	{
		$this->password = $password;

		return $this;
	}

	/**
	 * Set user email
	 *
	 * @param string $email
	 * @return self
	 */
	public function setEmail(string $email): self
	{
		$this->email = $email;

		return $this;
	}

	/**
	 * Set user list id
	 *
	 * @param string $listId
	 * @return self
	 */
	public function setListId(string $listId): self
	{
		$this->listId = $listId;

		return $this;
	}

	/**
	 * Get user name
	 *
	 * @return string|null
	 */
	public function getName(): ?string
	{
		return $this->name;
	}

	/**
	 * Get user password
	 *
	 * @return string|null
	 */
	public function getPassword(): ?string
	{
		return $this->password;
	}

	/**
	 * Get user email
	 *
	 * @return string|null
	 */
	public function getEmail(): ?string
	{
		return $this->email;
	}

	/**
	 * Get list id
	 *
	 * @return string|null
	 */
	public function getListId(): ?string
	{
		return $this->listId;
	}

	/**
	 * To array
	 *
	 * @return array
	 */
	public function toArray(): array
	{
		return array_filter([
			'name'     => $this->name,
			'password' => $this->password,
			'email'    => $this->email,
			'list_id'  => $this->listId
		]);
	}
}