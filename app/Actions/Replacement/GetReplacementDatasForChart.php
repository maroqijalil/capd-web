<?php

namespace App\Actions\Replacement;

use App\Models\Replacement;
use App\Models\ReplacementDetail;
use App\Models\User;
use DateTime;
use Google\Cloud\Firestore\FirestoreClient;
use Kreait\Firebase\Firestore;
use Lorisleiva\Actions\Concerns\AsAction;

class GetReplacementDatasForChart
{
  use AsAction;

  protected FirestoreClient $db;

  public function __construct(Firestore $firestore)
  {
    $this->db = $firestore->database();
  }

  public function handle($id): array
  {
    $todays_stamp = new DateTime();
    $todays_stamp->setTime(0, 0);
    $todays_stamp = $todays_stamp->format('U');

    $previous_stamp = DateTime::createFromFormat('Y-m-d', date('Y-m-d', strtotime('-7 days')));
    $previous_stamp->setTime(0, 0);
    $previous_stamp = $previous_stamp->format('U');

    $path = $this->db->collection(User::getRefName())
      ->document($id)
      ->collection(Replacement::getRefName());

    $replacements = $path
      ->where('tanggal_stamp', '>', $previous_stamp + 0)
      ->where('tanggal_stamp', '<=', $todays_stamp + 0)
      ->orderBy('tanggal_stamp', 'DESC')
      ->documents();
    
    $liquids = [];
    $replacements_label = [];
    $replacements_data1 = [];
    $replacements_data2 = [];
    foreach ($replacements as $replacement) {
      if ($replacement->exists()) {
        array_push($replacements_label, $replacement->data()['tanggal']);

        $replacement_details = $path->document($replacement->id())
          ->collection(ReplacementDetail::getRefName())
          ->orderBy('waktu_masuk_stamp', 'DESC')
          ->documents();
        
        $rpl_in = 0.0;
        $rpl_out = 0.0;
        foreach ($replacement_details as $rplc_dtls) {
          if ($rplc_dtls->exists()) {
            $replacement_detail = new ReplacementDetail($rplc_dtls->data());
            array_push($liquids, $replacement_detail->nama_cairan." ".$replacement_detail->konsentrasi);
            $rpl_in += ($replacement_detail->volume_masuk + 0.0);
            $rpl_out += ($replacement_detail->volume_keluar + 0.0);
          }
        }
        array_push($replacements_data1, $rpl_in);
        array_push($replacements_data2, $rpl_out);
      }
    }

    $liquids = array_count_values($liquids);
    $liquids_vals = array_values($liquids);
    $liquids_sum = array_sum($liquids_vals);

    for ($i = 0; $i < count($liquids_vals); $i++) {
      $liquids_vals[$i] *= 100;
      $liquids_vals[$i] /= $liquids_sum;
      $liquids_vals[$i] = round($liquids_vals[$i]);
    }

    $datas = [
      'pie' => [
        'label' => array_keys($liquids),
        'data' => $liquids_vals,
        'color' => ['#0694a2', '#1c64f2', '#7e3af2'],
      ],
      'line' => [
        'label' => $replacements_label,
        'data1' => $replacements_data1,
        'data2' => $replacements_data2,
      ],
    ];

    return $datas;
  }
}
