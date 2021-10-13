<?php

namespace App\View\Components;

use App\Actions\User\GetUser;
use Illuminate\View\Component;

class AppLayout extends Component
{
	public $title;
	public $user;

	public function __construct($title)
	{
		$this->title = $title;
		$this->user = GetUser::run();
	}

	public function render()
	{
		return view('layouts.app');
	}
}
