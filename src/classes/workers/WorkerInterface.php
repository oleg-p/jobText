<?php

	namespace App\classes\workers;

	interface WorkerInterface
	{
		/**
		 * @param string $text
		 * @return mixed
		 */
		public function getResult ($text);
	}