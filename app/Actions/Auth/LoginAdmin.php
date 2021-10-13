<?php

namespace App\Actions\Auth;

use App\Models\Account;
use App\Models\User;
use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Kreait\Firebase\Auth as FbAuth;
use Kreait\Firebase\Firestore;
use Lorisleiva\Actions\Concerns\AsAction;

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
    $user = new User($request);

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

    $result = $snapshot->data();

    $user->nama = $result['nama'];
    $user->alamat = $result['alamat'];
    $user->tanggal_lahir = $result['tanggal_lahir'];
    $user->no_hp = $result['no_hp'];
    $user->riwayat_penyakit = $result['riwayat_penyakit'];
    $user->foto_profil = $result['foto_profil'];

    return $user;
  }
}
