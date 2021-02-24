<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Portfolio;
use App\Category;
use App\Image;

class PortfolioController extends Controller
{
    /*função store*/
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'title'=>'required|string',
            'category_id'=>'required|integer',
            'image_id'=>'required|integer',
            'link'=>'required|string'
        ]);
        if($validator->fails()) {
            return response()->json([
                'dados'=>$validator->errors(),
                'mensagem'=>'Campo incorreto',
                'codigo'=>'400'
            ],400);
        }

        $category = Category::find($request->category_id);
        if(!$category) {
            return response()->json([
                'dados'=>$validator->errors(),
                'mensagem'=>'Categoria não encontrada',
                'codigo'=>'404'
            ],404);
        }

        $image = Image::find($request->image_id);
        if(!$image) {
            return response()->json([
                'dados'=>$validator->errors(),
                'mensagem'=>'Imagem não encontrada',
                'codigo'=>'404'
            ],404);
        }

        $portfolio_item = Portfolio::create($request->except('category_id'));
        $portfolio_item->categories()->attach($category);
        $portfolio_item->image()->associate($image);

        if(!$portfolio_item) {
            return response()->json([
                'mensagem'=>'Erro ao criar item',
                'codigo'=>'500'
            ],500);
        }

        return response()->json([
            'dados'=> $portfolio_item,
            'mensagem'=>'Item criado com sucesso',
            'codigo'=>'201'
        ],201); 
    }

    /*função update*/
    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'id'=>'required|string',
            'title'=>'nullable|string',
            'category_id'=>'nullable|integer',
            'link'=>'nullable|string'
        ]);

        if($validator->fails()) {
            return response()->json([
                'dados'=>$validator->errors(),
                'mensagem'=>'Campo incorreto',
                'codigo'=>'400'
            ],400);
        }

        /* caso seja passada uma categoria para atualizar*/
        $category = Category::find($request->category_id);
        if(!$category) {
            return response()->json([
                'dados'=>$validator->errors(),
                'mensagem'=>'Categoria não encontrada',
                'codigo'=>'404'
            ],404);
        }

        /* caso seja passada uma imagem para atualizar*/
        $image = Image::find($request->image_id);
        if(!$image) {
            return response()->json([
                'dados'=>$validator->errors(),
                'mensagem'=>'Imagem não encontrada',
                'codigo'=>'404'
            ],404);
        }

        $portfolio_item = Portfolio::find($request->id);
        if(!$portfolio_item) {
            return response()->json([
                'mensagem'=>'Item não encontrado',
                'codigo'=>'404'
            ],404);
        }

        $portfolio_item->update($request->all());
        if(!$portfolio_item) {
            return response()->json([
                'mensagem' => 'Erro ao atualizar item',
                'codigo' => '500'
            ], 500);
        }

        return response()->json([
            'mensagem' => 'Item atualizado com sucesso',
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

        $portfolio_item = Portfolio::find($request->id);
        if(!$portfolio_item) {
            return response()->json([
                'mensagem'=>'Item não encontrado',
                'codigo'=>'404'
            ],404);
        }

        $portfolio_item->categories()->detach();

        $portfolio_item->delete();
        return response()->json([
            'mensagem'=>'Item deletado com sucesso',
            'codigo'=>'200'
        ],200);
    } 

    /*função index*/
    public function index()
    {
        $portfolio_item = Portfolio::all();
        if($portfolio_item->count() > 0) {
            return response()->json([
                'mensagem'=>'Itens existentes:',
                'dados'=>$portfolio_item,
                'codigo'=>'200'
            ],200);
        }
        return response()->json([
            'mensagem'=>'Não há nenhum item'
        ]);
    }    

    /*função show*/
    public function show($id) {

        $id = Portfolio::find($id);
        
        if(!$id) {
            return response()->json([
                'mensagem'=>'Item com este id não encontrado',
                'codigo'=>'404'
            ],404);
        }
        return response()->json([
            'mensagem'=> $id,
            'codigo'=>'200'
        ],200);
    } 

    /* função para tabela pivo n:n com category*/
    public function category(Request $request) {

        $validator = Validator::make($request->all(), [
            'id'=>'required|integer',
            'category'=>'required|array',
            'category.*'=>'required|integer'
        ]);

        if($validator->fails()) {
            return response()->json([
                'dados'=>$validator->errors(),
                'mensagem'=>'Campo incorreto',
                'codigo'=>'400'
            ],400);
        }

        /* validando se a categoria existe */
        foreach($request->categories as $categoryid) {
            $category = Category::find($categoryid); 
            if(!$category)
                return response()->json([
                    'mensagem' => "Categoria com id $categoryid não encontrada",
                    'codigo' => '404'
                ],404);
        }

        $portfolio_item = Portfolio::find($request->id);
        if(!$portfolio_item)
            return response()->json([
                'mensagem'=>'Item não encontrado',
                'codigo'=>'404'
            ],404);

        $portfolio_item->categories()->attach($request->categories);
        return response()->json([
            'mensagem' => 'Categorias adicionadas com sucesso',
            'codigo' => '201'
        ],201);
    }
    

}
