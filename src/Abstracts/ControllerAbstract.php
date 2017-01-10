<?php

namespace ApiArchitect\Compass\Abstracts;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use ApiArchitect\Repositories\HttpLogRepository;
use Illuminate\Foundation\Validation\ValidatesRequests;

/**
 * Class ControllerAbstract
 *
 * @package ApiArchitect
 * @author James Kirkby <hello@jameskirkby.com>
 */
abstract class ControllerAbstract extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * @var
     */
    public $httpLogRepo;
    /**
     * ControllerAbstract constructor.
     *
     * @param HttpLogRepository $httpLogRepository
     * @param Request $request
     */
    public function __construct(HttpLogRepository $httpLogRepository,Request $request)
    {
        $this->beforeFilter(function ($httpLogRepository,$request) {
            //if request is a get check cache for response first
            if($request->getMethod() == 'get')
            {
                //@TODO Check if response is cached and return
            }
        });
    }
}