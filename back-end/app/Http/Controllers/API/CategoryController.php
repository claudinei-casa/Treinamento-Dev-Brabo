<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Category;

class CategoryController extends Controller
{
    /* função index */
    public function index ()
    {
        $category = Category::all();
            return response()->json([
                'mensagem'=>'Categorias existentes:', 
                'dados'=>$category,
                'codigo'=>'200'
            ],200);
    }
    /*função show */
    public function show($id) 
    {
        $id = Category::find($id);
        if($id) {
            return response()->json([
                'mensagem'=>'Nenhuma categoria com esse id foi encontrada',
                'codigo'=>'404'

            ],404);
        }
        return response()->json([
            'mensagem'=> $id,
            'codigo'=>'200'
        ],200);
    }
    /*função store*/
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'=>'required|string',
        ]);

        if($validator->fails()) {
            return response()->json([
                'dados'=>$validator->errors(),
                'mensagem'=>'Campo incorreto',
                'codigo'=>'400'
            ],400);
        }

        $category = Category::create($request->all());
        if(!$category) {
            return response()->json([
                'mensagem'=>'Erro ao criar categoria',
                'codigo'=>'500'
            ],500);
        }

        return response()->json([
            'dados' => $category,
            'mensagem'=>'Categoria criada com sucesso',
            'codigo'=>'201'
        ],201);
    }

    /*função update*/
    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'id'=>'required|integer',
            'name'=>'required|string',
        ]);

        if($validator->fails()) {
            return response()->json([
                'dados'=>$validator->errors(),
                'mensagem'=>'Campo incorreto',
                'codigo'=>'400'
            ],400);
        }

        $category = Category::find($request->id);
        if(!$category) {
            return response()->json([
                'mensagem'=>'Categoria não encontrada',
                'codigo'=>'404'
            ],404);
        }

        $category->update($request->all());
        if(!$category) {
            return response()->json([
                'mensagem' => 'Erro ao atualizar categoria',
                'codigo' => '500'
            ], 500);
        }

        return response()->json([
            'mensagem' => 'Categoria atualizada com sucesso',
            'codigo' => '200',
        ], 200); 

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

        $category = Category::find($request->id);
        if(!$category) {
            return response()->json([
                'mensagem'=>'Categoria não encontrada',
                'codigo'=>'404'
            ],404);
        }

        $category->delete();
        return response()->json([
            'mensagem'=>'Categoria deletada com sucesso',
            'codigo'=>'200'
        ],200);
    }

}
