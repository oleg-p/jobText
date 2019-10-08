<?php

	namespace App\Tests\classes;

	use PHPUnit\Framework\TestCase;
	use App\classes\Job;

	class JobTest extends TestCase
	{
		public function testJobChain ()
		{
			$data = $this->getData('job.txt');
			$jsonJob = json_decode($data);

			/** @var Job $job */
			$job = Job::create($jsonJob->job);
			$job->runChain();
			$result = $job->getResult();

			$this->assertEquals(10, $result['text']);
		}

		public function testJobChain2 ()
		{
			$data = $this->getData('job2.txt');
			$jsonJob = json_decode($data);

			/** @var Job $job */
			$job = Job::create($jsonJob->job);
			$job->runChain();
			$result = $job->getResult();

			$this->assertEquals('Приветмненаtesttestruпришлоприглашениевстретитьсяпопитькофес10содержаниеммолоказа5пойдемвместе', $result['text']);
		}

		public function testJob ()
		{
			$data = $this->getData('job.txt');
			$jsonJob = json_decode($data);

			/** @var Job $job */
			$job = Job::create($jsonJob->job);
			$job->run();
			$results = $job->getResults();

			$this->assertEquals(6, count($results));
			$this->assertEquals(10, $results[5]['text']);
		}

		public function testJob2 ()
		{
			$data = $this->getData('job2.txt');
			$jsonJob = json_decode($data);

			/** @var Job $job */
			$job = Job::create($jsonJob->job);
			$job->run();
			$results = $job->getResults();

			$this->assertEquals(5, count($results));

			$this->assertEquals(
				'Привет мне на <a href="testtestru">testtestru</a> пришло приглашение встретиться попить кофе с <strong>10</strong> содержанием молока за <i>5</i> пойдем вместе',
				$results[4]['text']
			);
		}

		/**
		 * @param string $nameFile
		 * @return bool|string
		 */
		private function getData ($nameFile)
		{
			return file_get_contents($this->getDataPath() . '/' . $nameFile);
		}

		/**
		 * @return string
		 */
		private function getDataPath ()
		{
			return __DIR__ . '/' . 'data';
		}
	}