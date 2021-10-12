<?php

namespace App\Models;

class ReplacementDetail
{
  public string $nama_cairan;
  public float $konsentrasi;
  public float $volume_masuk;
  public float $volume_keluar;
  public float $durasi_min;
  public float $durasi_max;
  public string $waktu_masuk;
  public string $waktu_keluar;
  public int $waktu_masuk_stamp;
  public int $waktu_keluar_stamp;
  public bool $status_diganti;
  public string $foto_cairan;
  public string $warna;
  public float $akurasi;
  public string $kondisi;
  public string $rekomendasi;
  public string $keluhan;
  public float $tensi;

	public function getRefName(): string {
		return "detail_penggantian";
	}
}
