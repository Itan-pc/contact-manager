<?php

namespace App;

use App\Contracts\Member;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserContact extends Model implements Member
{
	protected $fillable = [
		'user_id',
		'first_name',
		'email',
		'phone_number',
		'member_id'
	];

	/**
	 * User
	 *
	 * @return BelongsTo
	 */
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	/**
	 * To member
	 *
	 * @return array
	 */
	public function toMember(): array
	{
		return [
			'first_name'   => $this->first_name,
			'phone_number' => $this->phone_number,
			'email'        => $this->email
		];
	}
}
