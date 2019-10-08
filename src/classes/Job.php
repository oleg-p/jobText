<?php

	namespace App\classes;

	use App\classes\workers\WorkerInterface;

	class Job
	{
		/**
		 * @var string
		 */
		private $text;

		/**
		 * @var array
		 */
		private $methods;

		/**
		 * @var array
		 */
		private $results = [];

		/**
		 * Job constructor.
		 * @param string $text
		 * @param array  $methods
		 */
		public function __construct ($text, array $methods)
		{
			$this->text = $text;
			$this->methods = $methods;
		}

		/**
		 * @param $job
		 * @return static
		 */
		public static function create ($job)
		{
			return new static($job->text, $job->methods);
		}

		public function run ()
		{
			$factory = new WorkerFactory();

			foreach ($this->methods as $method)
			{
				/** @var WorkerInterface $worker */
				$worker = $factory->createDynamically($method);

				$this->results [] = ['text' => $worker->getResult($this->text)];
			}
		}

		/**
		 * @return array
		 */
		public function getResults () : array
		{
			return $this->results;
		}
	}