<?php

	namespace App\classes\workers;

	class RemoveSymbols implements WorkerInterface
	{
		public function getResult ($text)
		{
			return str_replace($this->getSymbols(), '', $text);
		}

		/**
		 * @return array
		 */
		private function getSymbols ()
		{
			return [
				'[',
				'.',
				',',
//				'/',
				'!',
				'@',
				'#',
				'$',
				'%',
				'^',
				'&',
				'*',
				'(',
				')',
				']',
			];
		}
	}