<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Validator;
use App\Image;

class ImageController extends Controller
{
    /*função store*/
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'image'=>'required|file',
            'description'=>'required|string'
        ]);

        if($validator->fails()) {
            return response()->json([
                'dados'=>$validator->errors(),
                'mensagem'=>'Campo incorreto',
                'codigo'=>'400'
            ],400);
        }

        $imagePath = Storage::putFile('public/images', $request->file('image'), 'public');
        $imagePath = substr($imagePath,7);
        $image = new Image();
        $image->description = $request->description;
        $image->path = $imagePath;
        $image->save();

        return response()->json([
            'dados' => $image,
            'mensagem'=>'Imagem criada com sucesso',
            'codigo'=>'201'
        ],201);
    }

    /*função update*/
    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'id'=>'required|integer',
            'image'=>'nullable|file',
            'description'=>'nullable|string'
        ]);

        if($validator->fails()) {
            return response()->json([
                'dados'=>$validator->errors(),
                'mensagem'=>'Campo incorreto',
                'codigo'=>'400'
            ],400);
        }

        $image = Image::find($request->id);
        if(!$image) {
            return response()->json([
                'dados'=>$validator->errors(),
                'mensagem'=>'Imagem não encontrada',
                'codigo'=>'404'
            ],404);
        }
        if($request->has('image')) {
            Storage::delete('public/' . $image->path);
            $imagePath = Storage::putFile('public/images', $request->file('image'), 'public');
            $imagePath = substr($imagePath,7);
            $image->path = $imagePath;
        }
        $image->description = $request->description;
        $image->save();
        return response()->json([
            'mensagem' => 'Imagem atualizada com sucesso',
            'codigo' => '201',
        ], 201); 
    }

    /*função destroy*/
    public function destroy(Request $request) {
        $validator = Validator::make($request->all(), [
            'id'=>'required|integer',
        ]);

        if($validator->fails()) {
            return response()->json([
                'dados'=>$validator->errors(),
                'mensagem'=>'Campo incorreto',
                'codigo'=>'400'
            ],400);
        }

        $image = Image::find($request->id);
        if(!$image) {
            return response()->json([
                'dados'=>$validator->errors(),
                'mensagem'=>'Imagem não encontrada',
                'codigo'=>'404'
            ],404);
        }
        Storage::delete($image->path);
        $image->delete();
        return response()->json([
            'mensagem' => 'Imagem deletada com sucesso',
            'codigo' => '200',
        ], 200); 
    }

    /*função index*/
    public function index() {
        $image = Image::all();

        if($image->count() > 0) {
            return response()->json([
                'mensagem'=>'Imagens existentes:',
                'dados'=>$image,
                'codigo'=>'200'
            ],200);
        }
        return response()->json([
            'mensagem'=>'Não há imagens'
        ]);
    }

    /*função show*/
    public function show($id) {

        $id = Image::find($id);
        
        if(!$id) {
            return response()->json([
                'mensagem'=>'Imagem com este id não encontrada',
                'codigo'=>'404'
            ],404);
        }
        return response()->json([
            'mensagem'=> $id,
            'codigo'=>'200'
        ],200);
    }
}

