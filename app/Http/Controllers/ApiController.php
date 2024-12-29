<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Fabrics\ActionsFabric;

class ApiController
{
    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        if(!$request->action){
            return response()->json('no action', 200);
        }

        $action = ActionsFabric::createAction($request->action);

        if(!$action){
            return response()->json('wrong action', 200);
        }

        $check = $action->check($request);

        if($check['success']){
            $res = $action->do($request);
            return response()->json($res, 200);
        }
        else{
            return response()->json($check['message'], 400);
        }
    }
}
