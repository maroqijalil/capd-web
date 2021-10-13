<?php

namespace App\Actions\User;

use App\Models\User;
use Google\Cloud\Firestore\FirestoreClient;
use Kreait\Firebase\Firestore;
use Lorisleiva\Actions\Concerns\AsAction;
use Session;

class GetUser
{
  use AsAction;

  protected FirestoreClient $db;

  public function __construct(Firestore $firestore)
  {
    $this->db = $firestore->database();
  }

  public function handle(): ?User
  {
    $uid = Session::get('user_id');
    $snapshot = $this->db->collection(User::getRefName())->document($uid)->snapshot();

    if (!$snapshot->exists()) {
      return null;
    }

    return new User($snapshot->data());
  }
}
