<?php

	namespace App\classes\workers;

	class ToNumber implements WorkerInterface
	{
		public function getResult ($text)
		{
			preg_match('|\d+|', $text, $matches);

			return (int) $matches[0];

		}
	}