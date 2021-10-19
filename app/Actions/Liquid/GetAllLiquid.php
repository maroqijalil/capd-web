<?php

namespace App\Actions\Liquid;

use App\Models\Liquid;
use Google\Cloud\Firestore\FirestoreClient;
use Kreait\Firebase\Firestore;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAllLiquid
{
  use AsAction;

  protected FirestoreClient $db;

  public function __construct(Firestore $firestore)
  {
    $this->db = $firestore->database();
  }

  public function handle(): array
  {
    $documents = $this->db->collection(Liquid::getRefName())->documents();

    $datas = [];
    foreach ($documents as $doc) {
      if ($doc->exists()) {
        array_push($datas, new Liquid($doc->data()));
      }
    }

    return $datas;
  }
}
