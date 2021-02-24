<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Testimony;
use App\Image;

class TestimonyController extends Controller
{
    /*função store*/
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'=>'required|string',
            'role'=>'required|string',
            'description'=>'required|string',
            'image_id'=>'required|integer'
        ]);
        if($validator->fails()) {
            return response()->json([
                'dados'=>$validator->errors(),
                'mensagem'=>'Campo incorreto',
                'codigo'=>'400'
            ],400);
        }

        $image = Image::find($request->image_id);
        if(!$image) {
            return response()->json([
                'dados'=>$validator->errors(),
                'mensagem'=>'Imagem não encontrada',
                'codigo'=>'404'
            ],404);
        }

        $testimony = Testimony::create($request->all());
        if(!$testimony) {
            return response()->json([
                'mensagem'=>'Erro ao criar depoimento',
                'codigo'=>'500'
            ],500);
        }

        return response()->json([
            'dados' => $testimony,
            'mensagem'=>'Depoimento criado com sucesso',
            'codigo'=>'201'
        ],201);
    }

    /*função update*/
    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'id'=>'required|string',
            'name'=>'nullable|string',
            'role'=>'nullable|string',
            'description'=>'nullable|string',
            'image_id'=>'nullable|integer'
        ]);

        if($validator->fails()) {
            return response()->json([
                'dados'=>$validator->errors(),
                'mensagem'=>'Campo incorreto',
                'codigo'=>'400'
            ],400);
        }

        $image = Image::find($request->image_id);
        if(!$image) {
            return response()->json([
                'dados'=>$validator->errors(),
                'mensagem'=>'Imagem não encontrada',
                'codigo'=>'404'
            ],404);
        }

        $testimony = Testimony::find($request->id);
        if(!$testimony) {
            return response()->json([
                'mensagem'=>'Depoimento não encontrado',
                'codigo'=>'404'
            ],404);
        }

        $testimony->update($request->all());
        if(!$testimony) {
            return response()->json([
                'mensagem' => 'Erro ao atualizar depoimento',
                'codigo' => '500'
            ], 500);
        }

        return response()->json([
            'mensagem' => 'Depoimento atualizado com sucesso',
            'codigo' => '201'
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

        $testimony = Testimony::find($request->id);
        if(!$testimony) {
            return response()->json([
                'mensagem'=>'Depoimento não encontrado',
                'codigo'=>'404'
            ],404);
        }

        $testimony->delete();
        return response()->json([
            'mensagem'=>'Depoimento deletado com sucesso',
            'codigo'=>'200'
        ],200);
    } 

    /*função index*/
    public function index()
    {
        $testimony = Testimony::all();
        if($testimony->count() > 0) {
            return response()->json([
                'mensagem'=>'Depoimentos existentes:',
                'dados'=>$testimony,
                'codigo'=>'200'
            ],200);
        }
        return response()->json([
            'mensagem'=>'Não há depoimentos'
        ]);
    }   

    /*função show*/
    public function show($id) {

        $id = Testimony::find($id);
        
        if(!$id) {
            return response()->json([
                'mensagem'=>'Depoimento com este id não encontrado',
                'codigo'=>'404'
            ],404);
        }
        return response()->json([
            'mensagem'=> $id,
            'codigo'=>'200'
        ],200);
    }

}

