<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Replacement extends Model
{
  use HasFactory;

  protected $fillable = [
    'tanggal',
    'tanggal_stamp',
    'urin',
    'hasil_prediksi',
    'status_penggantian',
  ];

	public static function getRefName(): string {
		return "penggantian";
	}
}
