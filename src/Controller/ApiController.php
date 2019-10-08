<?php

	namespace App\Controller;

	/**
	 * Created by PhpStorm.
	 * User: oleg
	 * Date: 07.10.2019
	 * Time: 18:36
	 */
	use App\classes\Job;
	use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
	use Symfony\Component\Routing\Annotation\Route;
	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\HttpFoundation\Response;
	use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

	class ApiController extends AbstractController
	{
		/**
		 * @Route("/api/job", name="api_job", methods={"GET"}),
		 */
		public function job(Request $request)
		{
			$data = $this->retrieveData($request);

			$jsonJob = json_decode($data);

			if (!empty($jsonJob)) {
				/** @var Job $job */
				$job = Job::create($jsonJob->job);
				$job->run();

				return $this->json([
					'results' => $job->getResults()
				]);
			}

			return $this->json([
				'result' => 'Неверные данные',
			]);
		}

		/**
		 * @param Request $request
		 * @return string
		 */
		private function retrieveData ($request)
		{
			$data = $request->get('data', null);

			if ($data === null) {
				throw new BadRequestHttpException('Missing parameter "data"');
			}

			return trim($data);
		}
	}