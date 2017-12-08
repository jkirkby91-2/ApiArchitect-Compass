<?php
	declare(strict_types=1);

	namespace ApiArchitect\Compass\Http\Requests {

		use Psr\Http\Message\ServerRequestInterface;

		/**
		 * Class AbstractValidateRequest
		 *
		 * @package ApiArchitect\Compass\Http\Requests
		 * @author  James Kirkby <jkirkby@protonmail.ch>
		 */
		abstract class AbstractValidateRequest extends \Jkirkby91\LumenRestServerComponent\Http\Requests\AbstractValidateRequest
		{

			/**
			 * rules()
			 * @param \Psr\Http\Message\ServerRequestInterface $request
			 *
			 * @return array
			 */
			abstract public function rules(ServerRequestInterface $request) : array;
		}
	}
