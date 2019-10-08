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
		 * @var array
		 */
		private $result = [];

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

		/**
		 * Паралелльная обработка
		 */
		public function run ()
		{
			$factory = new WorkerFactory();

			foreach ($this->methods as $method)	{
				/** @var WorkerInterface $worker */
				$worker = $factory->createDynamically($method);

				$this->results [] = ['text' => $worker->getResult($this->text)];
			}
		}

		/**
		 * Обработка по цепочке
		 */
		public function runChain ()
		{
			$factory = new WorkerFactory();

			$text = $this->text;
			foreach ($this->methods as $method)	{
				/** @var WorkerInterface $worker */
				$worker = $factory->createDynamically($method);

				$text = $worker->getResult($text);
			}

			$this->result = ['text' => $text];
		}

		/**
		 * @return array
		 */
		public function getResults () : array
		{
			return $this->results;
		}

		/**
		 * @return array
		 */
		public function getResult () : array
		{
			return $this->result;
		}

	}