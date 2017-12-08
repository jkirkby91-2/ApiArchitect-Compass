<?php
	declare(strict_types=1);

	namespace ApiArchitect\Compass\Exceptions {

		/**
		 * Class ApiException
		 *
		 * @package ApiArchitect\Compass\Exceptions
		 * @author  James Kirkby <jkirkby@protonmail.ch>
		 * @TODO Implement
		 */
		class ApiException extends \Exception
		{
			/**
			 * render()
			 * @param \Exception $e
			 */
			public function render(\Exception $e){}
		}
	}
