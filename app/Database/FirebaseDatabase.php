<?php

namespace App\Database;

use App\Models\Account;
use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Hashing\Hasher;
use Kreait\Firebase\Auth as FbAuth;
use Kreait\Firebase\Firestore;
use Kreait\Laravel\Firebase\Facades\Firebase;

class FirebaseDatabase implements UserProvider
{
  protected Hasher $hash;
  protected string $model;
  protected FbAuth $auth; 

  public function __construct(Hasher $hash, $model)
  {
    $this->hash = $hash;
    $this->model = $model;
    $this->auth = Firebase::auth();
  }
  
  public function retrieveById($identifier): Account
  {
    $fbUser = $this->auth->getUser($identifier);
    return new Account([
      'localId' => $fbUser->uid,
      'email' => $fbUser->email,
      'displayName' => $fbUser->displayName
    ]);
  }

  public function retrieveByToken($identifier, $token) {}

  public function updateRememberToken(Authenticatable $user, $token) {}

  public function retrieveByCredentials(array $credentials) {}

  public function validateCredentials(Authenticatable $user, array $credentials) {}
}
