<?php

namespace App\Models;

class User
{
  public string $nama;
  public string $alamat;
  public string $tanggal_lahir;
  public string $no_hp;
  public string $email;
  public string $password;
  public array $riwayat_penyakit;
  public string $foto_profil;

	public function __construct(string $email, string $password)
	{
		$this->email = $email;
		$this->password = $password;
	}

	public static function getRefName(): string {
		return "pengguna";
	}
}
