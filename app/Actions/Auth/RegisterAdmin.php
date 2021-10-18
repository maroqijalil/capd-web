<?php

namespace App\Actions\Auth;

use App\Models\Account;
use App\Models\User;
use Google\Cloud\Firestore\FirestoreClient;
use Kreait\Firebase\Auth as FbAuth;
use Kreait\Firebase\Firestore;
use Lorisleiva\Actions\Concerns\AsAction;

class RegisterAdmin
{
  use AsAction;

  protected FbAuth $auth;
  protected FirestoreClient $db;

  public function __construct(FbAuth $auth, Firestore $firestore)
  {
    $this->auth = $auth;
    $this->db = $firestore->database();
  }

  public function handle(array $request): bool
  {
    $registerResult = $this->auth->createUserWithEmailAndPassword(
      $request['email'],
      $request['password'],
    );

    if (!$registerResult) {
      return false;
    }

    $signInResult = $this->auth->signInAsUser($registerResult->uid);

    if (!$signInResult) {
      return false;
    }

    session(['user_id' => $registerResult->uid]);
    session(['token_id' => $signInResult->idToken()]);
    
    $new_user = [
      'nama' => $request['nama'],
      'email' => $request['email'],
      'password' => $request['password'],
      'tipe' => 'admin'
    ];

    $this->db->collection(User::getRefName())
      ->document($registerResult->uid)
      ->set($new_user);

    return true;
  }
}
