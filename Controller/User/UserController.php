<?php

namespace Controller\User;

use \Framework\View\View;
use \Tools\Helper\UserHelper;
use \Model\User\User;
use \BLL\User\UserBLL;
use \Framework\Tools\Helper\RoutesHelper;
use \Framework\Tools\Helper\PathHelper;

class UserController
{
	public function Login($queryParameters)
	{
		if (!UserHelper::IsLogin())
		{
			$path = PathHelper::GetPath([ "User", "LoginUser" ]);

			if ($_SERVER['REQUEST_METHOD'] === 'GET')
			{
				$view = new View($path);
				return $view->Render();
			}
			else if ($_SERVER['REQUEST_METHOD'] === 'POST') 
			{
				$user = new User();

				if (array_key_exists("user-username", $queryParameters))
				{
					$user->SetUsername($queryParameters["user-username"]->GetValue());
				}
				if (array_key_exists("user-password", $queryParameters))
				{
					$user->SetPassword($queryParameters["user-password"]->GetValue());
				}

				$userBLL = new UserBLL();
				$result = $userBLL->Exists($user);

				if ($result === true)
				{
					UserHelper::Login($user);
				}
				else
				{
					$view = new View($path);
					return $view->Render([ "user" => $user, "errors" => $result ]);
				}
			}
		}

		RoutesHelper::Redirect("DisplayHome");
	}

	public function Logout($queryParameters)
	{
		UserHelper::Logout();

		RoutesHelper::Redirect("DisplayHome");
	}
}