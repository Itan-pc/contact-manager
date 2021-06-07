<?php


namespace App\DTO;


use Illuminate\Contracts\Support\Arrayable;

class CreateUserDTO implements Arrayable
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
	 * RegisterUserDTO constructor.
	 *
	 * @param string $name
	 * @param string $email
	 * @param string $password
	 */
	public function __construct(string $name, string $email, string $password)
	{
		$this->name = $name;
		$this->email = $email;
		$this->password = $password;
	}

	/**
	 * Set user password
	 *
	 * @param string $password
	 */
	public function setPassword(string $password): void
	{
		$this->password = $password;
	}

	/**
	 * Get user name
	 *
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}

	/**
	 * Get user password
	 *
	 * @return mixed
	 */
	public function getPassword(): string
	{
		return $this->password;
	}

	/**
	 * Get user email
	 *
	 * @return mixed
	 */
	public function getEmail(): string
	{
		return $this->email;
	}

	/**
	 * To array
	 *
	 * @return array
	 */
	public function toArray(): array
	{
		return [
			'name'     => $this->name,
			'email'    => $this->email,
			'password' => $this->password
		];
	}
}