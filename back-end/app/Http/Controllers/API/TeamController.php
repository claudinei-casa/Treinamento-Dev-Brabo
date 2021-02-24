<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Image;
use App\Team;

class TeamController extends Controller
{
    
    /*função store*/
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'image_id'=>'required|integer',
            'name'=>'required|string',
            'role'=>'required|string',
            'twitter'=>'nullable|string',
            'facebook'=>'nullable|string',
            'instagram'=>'nullable|string',
            'linkedin'=>'nullable|string'
        ]); 

        if ($validator->fails()) {
            return response()->json([
                'dados'=>$validator->errors(),
                'mensagem'=>'Campo incorreto',
                'codigo'=>'400'
            ],400);
        }

        $image=Image::find($request->image_id);
        if(!$image) {
            return response()->json([
                'dados'=>$validator->errors(),
                'mensagem'=>'Imagem não encontrada',
                'codigo'=>'404'
            ],404);
        }

        $team_member = Team::create($request->all());
        if(!$team_member) {
            return response()->json([
                'mensagem'=>'Erro ao criar integrante da equipe',
                'codigo'=>'500'
            ],500);
        }

        return response()->json([
            'dados'=>$team_member,
            'mensagem'=>'Integrante da equipe criado com sucesso',
            'codigo'=>'201'
        ],201);
    }
        
    /*função update*/
    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'id'=>'required|integer',
            'image_id'=>'nullable|integer',
            'name'=>'nullable|string',
            'role'=>'nullable|string',
            'twitter'=>'nullable|string',
            'facebook'=>'nullable|string',
            'instagram'=>'nullable|string',
            'linkedin'=>'nullable|string'
        ]);

        if($validator->fails()) {
            return response()->json([
                'dados'=>$validator->errors(),
                'mensagem'=>'Campo incorreto',
                'codigo'=>'400'
            ],400);
        }

        $team_member = Team::find($request->id);
        if(!$team_member) {
            return response()->json([
                'mensagem'=>'Integrante da equipe não encontrado',
                'codigo'=>'404'
            ],404);
        }

        if($request->has('image_id')) {
            $image = Image::find($request->image_id);
            if(!$image) {
                return response()->json([
                    'mensagem'=>'Imagem não encontrada',
                    'codigo'=>'404'
                ],404);
            }
        }

        $team_member->update($request->all());
        if(!$team_member) {
            return response()->json([
                'mensagem'=>'Erro ao atualizar integrante da equipe',
                'codigo'=>'500'
            ],500);
        }

        return response()->json([
            'dados'=>$team_member,
            'mensagem'=>'Integrante da equipe atualizado com sucesso',
            'codigo'=>'201'
        ],201);
    }
    /*função destroy*/
    public function destroy($id) {
        $validator = Validator::make(['id'=>$id], [
            'id'=>'required|integer'           
        ]);

        if($validator->fails()) {
            return response()->json([
                'dados'=>$validator->errors(),
                'mensagem'=>'Erro de validação',
                'codigo'=>'400'
            ],400);
        }

        $team_member = Team::find($id);
        if(!$team_member) {
            return response()->json([
                'mensagem'=>'Integrante da equipe não encontrado',
                'codigo'=>'404'
            ],404);
        }

        $team_member->delete();
        return response()->json([
            'mensagem'=>'Integrante da equipe deletado com sucesso',
            'codigo'=>'200'
        ],200);
    }     

    /*função index*/
    public function index()
    {
        $team_member = Team::all();
        if($team_member->count() > 0) {
            return response()->json([
                'mensagem'=>'Membros existentes:',
                'dados'=>$team_member,
                'codigo'=>'200'
            ],200);
        }
        return response()->json([
            'mensagem'=>'Não há membros na equipe'
        ]);
    }    

    /*função show*/
    public function show($id) {
        $id = Team::find($id);
        
        if(!$id) {
            return response()->json([
                'mensagem'=>'Integrante da equipe com este id não encontrado',
                'codigo'=>'404'
            ],404);
        }
        return response()->json([
            'mensagem'=> $id,
            'codigo'=>'200'
        ],200);
    }

}
