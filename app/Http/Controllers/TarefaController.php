<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use App\Http\Controllers\Controller;
use App\Mail\NovaTarefaMall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
class TarefaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

                // $id = auth()->user()->id;
                // $email =  auth()->user()->email;
                // $name =  auth()->user()->name;
                // return "voce $id $email $name esta logado no sistema";

        // if(auth()->check()){
        //     $id = auth()->user()->id;
        //     $email = auth()->user()->email;
        //     $name = auth()->user()->name;
        //     return "voce $id $email $name esta logado no sistema";
        // } else {
        //     return 'voce não esta logado no sistema';
        // }


        // if(Auth::check()){
        //         $id = Auth::user()->id;
        //         $email =  Auth::user()->email;
        //         $name =  Auth::user()->name;
        //         return "voce $id $email $name esta logado no sistema";
        //     } else {
        //         return 'voce não esta logado no sistema';
        //     }
        $user_id = auth()->user()->id;
        $tarefas = Tarefa::where('user_id',$user_id)->paginate(1);
        return view('tarefa.index',['tarefas'=>$tarefas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('tarefa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
       // dd($request->all());
       $dados = $request->all('tarefa','data_limite_conclusao');
       $dados['user_id'] = Auth()->user()->id;
        //dd($dados);

       $tarefa = Tarefa::create($dados);

        $destinatario = auth()->user()->email;
        Mail::to($destinatario)->send(new NovaTarefaMall($tarefa));


       return redirect()->route('tarefa.show',['tarefa' => $tarefa->id]);
        //dd($tarefa->id);

    }

    /**
     * Display the specified resource.
     */
    public function show(Tarefa $tarefa)
    {
        //
         //dd($tarefa->getAttributes());
         return view('tarefa.show',['tarefa' => $tarefa]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarefa $tarefa)
    {
        return view('tarefa.edit',['tarefa' => $tarefa]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarefa $tarefa)
    {
        //
        // print_r($request->all());
        // echo '<hr>';
        // print_r($tarefa->getAttributes());
        $tarefa->update($request->all());
        return redirect()->route('tarefa.show',['tarefa' => $tarefa->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarefa $tarefa)
    {
        //
    }
}
