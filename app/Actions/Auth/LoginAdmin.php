<?php

namespace App\Actions\Auth;

use App\Models\Account;
use App\Models\User;
use Google\Cloud\Firestore\FirestoreClient;
use Kreait\Firebase\Auth as FbAuth;
use Kreait\Firebase\Firestore;
use Lorisleiva\Actions\Concerns\AsAction;
use Auth;
use Session;

class LoginAdmin
{
  use AsAction;

  protected FbAuth $auth;
  protected FirestoreClient $db;

  public function __construct(FbAuth $auth, Firestore $firestore)
  {
    $this->auth = $auth;
    $this->db = $firestore->database();
  }

  public function handle(array $request): ?User
  {
    $signInResult = $this->auth->signInWithEmailAndPassword(
      $request['email'],
      $request['password'],
    );

    if (!$signInResult) {
      return null;
    }

    $uid = $signInResult->firebaseUserId();
    Session::put('user_id', $uid);

    $snapshot = $this->db->collection(User::getRefName())->document($uid)->snapshot();

    if (!$snapshot->exists()) {
      return null;
    }

    $account = new Account($signInResult->data());
    Auth::login($account);

    return new User($snapshot->data());
  }
}
