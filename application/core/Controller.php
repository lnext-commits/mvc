<?php
namespace Core;

class Controller
{
	protected function before ($testId = FALSE)
	{
		if($userId = $_SESSION['id'])
		{
			if($testId>0)
			{
				if($testId != $userId)
				{
					header("location: /");
					exit;
				}
				else return $userId;
			}
			else return $userId;
		}
		else
		{
			header("location: /");
			exit;
		}
	}
}
