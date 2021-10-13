<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplacementDetail extends Model
{
  use HasFactory;

  protected $fillable = [
    'nama_cairan',
    'konsentrasi',
    'volume_masuk',
    'volume_keluar',
    'durasi_min',
    'durasi_max',
    'waktu_masuk',
    'waktu_keluar',
    'waktu_masuk_stamp',
    'waktu_keluar_stamp',
    'status_diganti',
    'foto_cairan',
    'warna',
    'akurasi',
    'kondisi',
    'rekomendasi',
    'keluhan',
    'tensi',
  ];

	public function getRefName(): string {
		return "detail_penggantian";
	}
}
