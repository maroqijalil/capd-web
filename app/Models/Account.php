<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;

class Account extends Authenticable
{
	use HasFactory, Notifiable;

	protected $fillable = [
		'displayName',
		'email',
		'localId',
	];

	protected $hidden = [
		'password',
		'remember_token',
	];

	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	public function getAuthIdentifierName()
	{
		return 'localId';
	}

	public function getAuthIdentifier()
	{
		return $this->localId;
	}
}
