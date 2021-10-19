<?php

namespace App\Actions\User;

use App\Models\User;
use Google\Cloud\Firestore\FirestoreClient;
use Kreait\Firebase\Firestore;
use Lorisleiva\Actions\Concerns\AsAction;

class GetAllUser
{
  use AsAction;

  protected FirestoreClient $db;

  public function __construct(Firestore $firestore)
  {
    $this->db = $firestore->database();
  }

  public function handle(): array
  {
    $documents = $this->db->collection(User::getRefName())
      ->documents();

    $datas = [];
    foreach ($documents as $doc) {
      if ($doc->exists()) {
        $user = new User($doc->data());
        $user->user_id = $doc->id();
        array_push($datas, $user);
      }
    }

    return $datas;
  }
}
