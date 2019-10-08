<?php

	namespace App\classes\workers;

	class ReplaceSpacesToEol implements WorkerInterface
	{
		public function getResult ($text)
		{
			return str_replace(' ', PHP_EOL, $text);
		}
	}