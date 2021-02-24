<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Service;

class ServiceController extends Controller
{
    /*função store*/
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'icon'=>'required|string',
            'service'=>'required|string',
            'description'=>'required|string'
        ]);

        if($validator->fails()) {
            return response()->json([
                'dados'=>$validator->errors(),
                'mensagem'=>'Campo incorreto',
                'codigo'=>'400'
            ],400);
        }

        $service = Service::create($request->all());
        if(!$service) {
            return response()->json([
                'mensagem'=>'Erro ao criar serviço',
                'codigo'=>'500'
            ],500);
        }

        return response()->json([
            'dados' => $service,
            'mensagem'=>'Serviço criado com sucesso',
            'codigo'=>'201'
        ],201);
    }

    /*função update*/
    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'id'=>'required|integer',
            'icon'=>'required|string',
            'service'=>'required|string',
            'description'=>'required|string'
        ]);

        if($validator->fails()) {
            return response()->json([
                'dados'=>$validator->errors(),
                'mensagem'=>'Campo incorreto',
                'codigo'=>'400'
            ],400);
        }

        $service = Service::find($request->id);
        if(!$service) {
            return response()->json([
                'mensagem'=>'Serviço não encontrado',
                'codigo'=>'404'
            ],404);
        }

        $service->update($request->all());
        if(!$service) {
            return response()->json([
                'mensagem' => 'Erro ao atualizar serviço',
                'codigo' => '500'
            ], 500);
        }

        return response()->json([
            'mensagem' => 'Serviço atualizado com sucesso',
            'codigo' => '201',
        ], 201); 

    }

    /*função destroy*/
    public function destroy(Request $request) {
        $validator = Validator::make($request->all(), [
            'id'=>'required|integer'           
        ]);

        if($validator->fails()) {
            return response()->json([
                'dados'=>$validator->errors(),
                'mensagem'=>'Erro de validação',
                'codigo'=>'400'
            ],400);
        }

        $service = Service::find($request->id);
        if(!$service) {
            return response()->json([
                'mensagem'=>'Serviço não encontrado',
                'codigo'=>'404'
            ],404);
        }

        $service->delete();
        return response()->json([
            'mensagem'=>'Serviço deletado com sucesso',
            'codigo'=>'200'
        ],200);
    }

    /*função index*/
    public function index()
    {
        $service = Service::all();
        if($service->count() > 0) {
            return response()->json([
                'mensagem'=>'Serviços existentes:',
                'servicos'=>$service,
                'codigo'=>'200'
            ],200);
        }
        return response()->json([
            'mensagem'=>'Não há serviços'
        ]);
    }

}

