<?php
	declare(strict_types=1);

	namespace ApiArchitect\Compass\Entities {

		use Doctrine\{
			ORM\Mapping as ORM
		};

		use Jkirkby91\{
			DoctrineSchemas\Entities\Thing,
			Boilers\SchemaBoilers\SchemaContract
		};

		/**
		 * Class AbstractResourceEntity
		 *
		 * @package ApiArchitect\Compass\Entities
		 * @author  James Kirkby <jkirkby@protonmail.ch>
		 *
		 * @ORM\MappedSuperclass
		 */
		abstract class AbstractResourceEntity extends Thing implements SchemaContract
		{

			/**
			 * @param $name
			 */
			public function __Construct($name)
			{
				parent::__Construct($name);
			}
		}
	}
