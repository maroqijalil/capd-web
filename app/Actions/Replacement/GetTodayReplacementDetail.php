<?php

namespace App\Actions\Replacement;

use App\Models\Replacement;
use App\Models\ReplacementDetail;
use App\Models\User;
use DateTime;
use Google\Cloud\Firestore\FirestoreClient;
use Kreait\Firebase\Firestore;
use Lorisleiva\Actions\Concerns\AsAction;

class GetTodayReplacementDetail
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

    $path = $this->db->collection(User::getRefName())
      ->document($id)
      ->collection(Replacement::getRefName());

    $replacements = $path
      ->where('tanggal_stamp', '>=', $todays_stamp + 0)
      ->documents();
    
    $datas = [];
    foreach ($replacements as $replacement) {
      if ($replacement->exists()) {
        $replacement_details = $path->document($replacement->id())
          ->collection(ReplacementDetail::getRefName())
          ->orderBy('waktu_masuk_stamp', 'DESC')
          ->documents();

        foreach ($replacement_details as $rplc_dtls) {
          if ($rplc_dtls->exists()) {
            $replacement_detail = new ReplacementDetail($rplc_dtls->data());
            $replacement_detail->replacement_detail_id = $rplc_dtls->id();
            array_push($datas, $replacement_detail);
          }
        }
      }
    }

    return $datas;
  }
}
