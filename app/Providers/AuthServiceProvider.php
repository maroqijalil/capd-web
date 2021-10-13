<?php

namespace App\Providers;

use App\Database\FirebaseDatabase;
use App\Models\Team;
use App\Policies\TeamPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
	/**
	 * The policy mappings for the application.
	 *
	 * @var array
	 */
	protected $policies = [
		Team::class => TeamPolicy::class,
	];

	/**
	 * Register any authentication / authorization services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->registerPolicies();

		\Illuminate\Support\Facades\Auth::provider('firebase',function($app, array $config) {
			return new FirebaseDatabase($app["hash"], $config['model']);
		});
	}
}
