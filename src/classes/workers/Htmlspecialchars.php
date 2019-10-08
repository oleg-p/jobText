<?php

	namespace App\classes\workers;

	class Htmlspecialchars implements WorkerInterface
	{
		public function getResult ($text)
		{
			return htmlspecialchars($text);
		}
	}