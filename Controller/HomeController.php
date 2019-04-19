<?php

namespace Controller;

use \Model\Blog\Post;
use \BLL\Blog\PostBLL;
use \Framework\View\View;
use \Framework\Tools\Helper\PathHelper;

class HomeController
{
	public function Display($queryParameters)
	{
		$postBLL = new PostBLL();
		//$posts = $postBLL->LoadByIsPublishedByCreationDateDesc();
		$posts = [];

		$path = PathHelper::GetPath([ "Home", "DisplayHome" ]);
		$view = new View($path);
		return $view->Render([ "posts" => $posts ]);
	}
}