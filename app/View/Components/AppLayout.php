<?php

namespace App\View\Components;

use App\Actions\User\GetUser;
use Illuminate\View\Component;

class AppLayout extends Component
{
	public $title;
	public $withMenu;
	public $user;
	public $userId;

	public function __construct($title, $withMenu = "true", $userId = "")
	{
		$this->title = $title;
		if ($withMenu == "true") {
			$this->withMenu = true;
		} else {
			$this->withMenu = false;
		}
		$this->user = GetUser::run();
		$this->userId = $userId;
	}

	public function render()
	{
		return view('layouts.app');
	}
}
