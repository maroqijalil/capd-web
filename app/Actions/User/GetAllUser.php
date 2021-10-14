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
    $documents = $this->db->collection(User::getRefName())->documents();

    $users = [];
    foreach ($documents as $doc) {
      if ($doc->exists()) {
        array_push($users, new User($doc->data()));
      }
    }

    return $users;
  }
}
