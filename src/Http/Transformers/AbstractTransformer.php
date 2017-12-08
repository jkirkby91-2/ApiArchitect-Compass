<?php
	declare(strict_types=1);

	namespace ApiArchitect\Compass\Http\Transformers {

		use League\{
			Fractal\TransformerAbstract as SuperAbstract
		};

		use Jkirkby91\{
			Boilers\RestServerBoiler\TransformerContract
		};

		/**
		 * Class AbstractTransformer
		 *
		 * @package ApiArchitect\Compass\Http\Transformers
		 * @author  James Kirkby <jkirkby@protonmail.ch>
		 */
		abstract class AbstractTransformer extends SuperAbstract implements TransformerContract
		{

			/**
			 * transform()
			 * @param $object
			 *
			 * @return array
			 */
			abstract public function transform($object) : array;
		}
	}
