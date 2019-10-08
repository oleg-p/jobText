<?php

	namespace App\classes\workers;

	class RemoveSpaces implements WorkerInterface
	{
		public function getResult ($text)
		{
			return str_replace(' ', '', $text);
		}
	}