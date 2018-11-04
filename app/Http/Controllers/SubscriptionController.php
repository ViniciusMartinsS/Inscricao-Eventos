<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Services\Verificate;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "oi";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = $request->user()->id;
        $verificate = new Verificate;
        #Verificações antes da inscrição do usuário | (Está incrito? Palestra cheia? Evento mesmo horário?)
        $is_signed = $verificate->is_signed($user_id, $request->input('activity_id'));
        $is_full = $verificate->is_full($request->input('activity_id'));
        $event_time = $verificate->event_time($user_id, $request->input('activity_id'));
        if ($is_signed != true && $is_full != true && $event_time != true) {
            $subscription = new Subscription;
            $subscription->user_id = $user_id;
            $subscription->activity_id = $request->input('activity_id');
            if ($subscription->save()) 
                return redirect()->back()->with('subscriber', 'Inscrito com sucesso!');
        }
        if($is_signed == true)
            return redirect()->back()->with('sucess', 'Você já está cadastrado na atividade!');
        elseif($is_full == true)
            return redirect()->back()->with('sucess', 'Evento com capacidade máxima atingida!');
        elseif($event_time == true)
            return redirect()->back()->with('sucess', 'Possui evento no mesmo horário!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(Subscription $subscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscription $subscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Subscription::destroy($id)){
            return redirect()->back()->with('sucess', 'Inscrição Cancelada!');
        }
        return redirect()->back()->with('error', 'Erro ao cancelar inscrição!');
    }
}
