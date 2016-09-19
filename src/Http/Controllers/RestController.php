<?php

namespace ApiArchitect\Compass\Http\Controllers;

use Dingo\Api\Routing\Helpers;
use League\Fractal;
use Illuminate\Http\Request;
use ApiArchitect\Compass\Libraries\RestControllerTrait;
use Laravel\Lumen\Routing\Controller AS BaseController;
use ApiArchitect\Compass\Contracts\ResourceControllerContract;

/**
 * Class ApiController
 *
 * @package Api\Controllers
 * @author James Kirkby <me@jameskirkby.com>
 */
abstract class RestController extends BaseController implements ResourceControllerContract
{
    use RestControllerTrait, Helpers;
}