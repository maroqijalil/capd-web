<?php

namespace App\Actions\Auth;

use App\Models\Account;
use App\Models\User;
use Kreait\Firebase\Auth as FbAuth;
use Lorisleiva\Actions\Concerns\AsAction;

class LoginAdmin
{
  use AsAction;

  protected FbAuth $auth;

  public function __construct(FbAuth $auth)
  {
    $this->auth = $auth;
  }

  public function handle(array $request): ?Account
  {
    $signInResult = $this->auth->signInWithEmailAndPassword(
      $request['email'],
      $request['password'],
    );

    if (!$signInResult) {
      return null;
    }

    $account = new Account($signInResult->data());

    $uid = $account->localId;
    session(['user_id' => $uid]);
    session(['token_id' => $signInResult->idToken()]);

    return $account;
  }
}
