<?php

namespace App\Models;

class Replacement
{
  public string $tanggal;
  public int $tanggal_stamp;
  public float $urin;
  public string $hasil_prediksi;
  public bool $status_penggantian;

	public function getRefName(): string {
		return "penggantian";
	}
}
