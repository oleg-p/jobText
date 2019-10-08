<?php

	namespace App\classes\workers;

	class DefaultMethod implements WorkerInterface
	{
		public function getResult ($text)
		{
			return '';
		}
	}