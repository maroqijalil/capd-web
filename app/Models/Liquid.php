<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Liquid extends Model
{
  use HasFactory;

  protected $fillable = [
    'durasi_min',
    'durasi_max',
    'konsentrasi',
    'nama_cairan',
  ];

	public static function getRefName(): string {
		return "cairan";
	}
}
