<?php

	namespace App\classes;

	use App\classes\workers\DefaultMethod;
	use App\classes\workers\Htmlspecialchars;
	use App\classes\workers\RemoveSpaces;
	use App\classes\workers\RemoveSymbols;
	use App\classes\workers\ReplaceSpacesToEol;
	use App\classes\workers\StripTags;
	use App\classes\workers\ToNumber;
	use App\classes\workers\WorkerInterface;

	class WorkerFactory
	{
		/**
		 * Создание класса обработчика по сравнению типов
		 *
		 * @param string $type
		 * @return WorkerInterface
		 */
		public function create ($type)
		{
			switch ($type) {
				case 'stripTags':
					$method = new StripTags();
					break;
				case 'removeSpaces':
					$method = new RemoveSpaces();
					break;
				case 'replaceSpacesToEol':
					$method = new ReplaceSpacesToEol();
					break;
				case 'htmlspecialchars':
					$method = new Htmlspecialchars();
					break;
				case 'removeSymbols':
					$method = new RemoveSymbols();
					break;
				case 'toNumber':
					$method = new ToNumber();
					break;

				default:
					$method = new DefaultMethod();
			}

			return $method;
		}

		/**
		 * Создание класса обработчика типу с динамическим формированием наименования класса
		 * Наименование класса должно быть равно наименованию типа, начинающейся с прописной буквы
		 * Файл класса должен быть расположен в папке src\classes\WorkerFactory.php и иметь namespace App\classes\workers;
		 * Класс должен реализовывать интерфейс App\classes\workers\WorkerInterface
		 *
		 * @param string $type
		 * @return WorkerInterface
		 */
		public function createDynamically ($type)
		{
			$nameClass = 'App\classes\workers' . '\\' .ucfirst($type);

			return new $nameClass();
		}
	}