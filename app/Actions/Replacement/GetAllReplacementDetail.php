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

  public function handle($id): array
  {
    $path = $this->db->collection(User::getRefName())
      ->document($id)
      ->collection(Replacement::getRefName());

    $replacements = $path->documents();

    $datas = [];
    foreach ($replacements as $rplcs) {
      if ($rplcs->exists()) {
        $replacement_details = $path->document($rplcs->id())
          ->collection(ReplacementDetail::getRefName())
          ->documents();

        foreach ($replacement_details as $rplc_dtls) {
          if ($rplc_dtls->exists()) {
            $replacement_detail = new ReplacementDetail($rplc_dtls->data());
            $replacement_detail->id = $rplc_dtls->id();
            array_push($datas, $replacement_detail);
          }
        }
      }
    }

    dd($datas);

    return $datas;
  }
}
