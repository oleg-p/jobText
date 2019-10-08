<?php

	namespace App\classes\workers;

	class StripTags implements WorkerInterface
	{
		public function getResult ($text)
		{
			return strip_tags($text);
		}
	}