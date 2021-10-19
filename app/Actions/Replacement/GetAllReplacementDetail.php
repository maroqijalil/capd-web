<?php

namespace App\Actions\Replacement;

use App\Models\Replacement;
use App\Models\ReplacementDetail;
use App\Models\User;
use Google\Cloud\Firestore\FirestoreClient;
use Kreait\Firebase\Firestore;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAllReplacementDetail
{
  use AsAction;

  protected FirestoreClient $db;

  public function __construct(Firestore $firestore)
  {
    $this->db = $firestore->database();
  }

  public function handle($id, $limit = -1): array
  {
    $path = $this->db->collection(User::getRefName())
      ->document($id)
      ->collection(Replacement::getRefName());

    $replacements = $path
      ->orderBy('tanggal_stamp', 'DESC');
    
    if ($limit != -1) {
      $replacements = $replacements->limit($limit);
    }

    $replacements = $replacements->documents();

    $datas = [];
    $index = 1;
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
          
          $index++;
          if ($limit != -1 && $index > $limit) {
            break;
          }
        }
      }

      if ($limit != -1 && $index > $limit) {
        break;
      }
    }

    return $datas;
  }
}
