<?php

namespace App\Actions\Auth;

use App\Models\Account;
use App\Models\User;
use Kreait\Firebase\Auth as FbAuth;
use Lorisleiva\Actions\Concerns\AsAction;

class LogoutAdmin
{
  use AsAction;

  protected FbAuth $auth;

  public function __construct(FbAuth $auth)
  {
    $this->auth = $auth;
  }

  public function handle(): bool
  {
    $uid = session()->get('user_id');
    $token = session()->get('token_id');

    if ($uid && $token) {
      $this->auth->revokeRefreshTokens($uid);
      session()->forget('user_id');
      session()->forget('token_id');
    }

    return true;
  }
}
