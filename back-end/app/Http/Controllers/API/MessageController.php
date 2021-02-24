<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Validator;
use App\Message;
use App\Http\Requests\CreateMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteMessage;

class MessageController extends Controller
{
    //Função Store
    public function store(CreateMessage $request)
    {
        $message = Message::create([
            'Name' => $request->Name,
            'Email' => $request->Email,
            'Subject' => $request->Subject,
            'Message' => $request->Message
        ]);

            return response()->json([
                'Mensagem enviada com sucesso!'
            ]);

    }
    //Função Index
    public function index()
    {
        $message = Message::all();
        return response()->json([
            'dados'=>$message
        ]);
    }
    //Função Destroy
    public function destroy(DeleteMessage $request) {
        $message = Message::find($request->id);
        if(!$message) {
            return response()->json([
                'mensagem'=>'A mensagem com este id não foi encontrada',
                'codigo'=>'404'
            ],404);
        }

        $message->delete();
        return response()->json([
            'mensagem'=>'Mensagem deletada com sucesso',
            'codigo'=>'200'
        ],200);
    }

}