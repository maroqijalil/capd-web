<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'nama',
    'alamat',
    'tanggal_lahir',
    'no_hp',
    'email',
    'password',
    'riwayat_panyakit',
    'foto_profil',
  ];

	public static function getRefName(): string {
		return "pengguna";
	}

  public function setId($id) {
    $this->id = $id;
  }
}
