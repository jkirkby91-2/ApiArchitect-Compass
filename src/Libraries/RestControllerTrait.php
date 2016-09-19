<?php

namespace ApiArchitect\Compass\Libraries;

use Illuminate\Http\Request;

/**
 * Class RestControllerTrait
 *
 * @package app\Compass\Libraries
 * @author James Kirkby <me@jameskirkby.com>
 */
trait RestControllerTrait
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return $this->listResponse($this->repository->all());
    }

    /**
     * @param $id
     * @return \Dingo\Api\Http\Response|void
     */
    public function show($id)
    {
        if($data = $this->repository->find($id))
        {
            return $this->response()->item($data,$this->transformer);
        }
        return $this->response()->errorNotFound();
    }

    /**
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->repository->create($request->all());

//        try
//        {
//            $v = \Validator::make($data, $this->validationRules);
//            if($v->fails())
//            {
//                throw new \Exception("ValidationException");
//            }
//            $data = $this->repository->create($data);
//            return $this->createdResponse($data);
//        } catch(\Exception $ex)
//        {
//            $data = ['form_validations' => $v->errors(), 'exception' => $ex->getMessage()];
//            return $this->clientErrorResponse($data);
//        }

        return $this->response()->item($data,$this->transformer);

    }

    /**
     * @param Request $request
     * @param $id
     * @return \Dingo\Api\Http\Response|void
     */
    public function update(Request $request,$id)
    {
        if(!$data = $this->repository->find($id))
        {
            return $this->response()->errorNotFound();
        }

//        try
//        {
//            $v = \Validator::make($request->all(), $this->validationRules);
//            if($v->fails())
//            {
//                throw new \Exception("ValidationException");
//            }
//            $this->repository->update($request->all());
//            return $this->showResponse($data);
//        }catch(\Exception $ex)
//        {
//            $data = ['form_validations' => $v->errors(), 'exception' => $ex->getMessage()];
//            return $this->clientErrorResponse($data);
//        }

        $this->repository->update($request->all());
        return $this->response()->item($data,$this->transformer);
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function destroy($id)
    {
        if(!$data = $this->repository->find($id))
        {
            return $this->response()->errorNotFound();
        }

        $this->repository->destory($id);

        return $this->response()->noContent();
    }
}
