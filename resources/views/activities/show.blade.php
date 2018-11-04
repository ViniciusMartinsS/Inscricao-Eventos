@extends('layouts.app')
@section('title', '{{ $activity->name }}')

@section('content')


<h1>{{ $activity->name }} </h1>

<ul>
	<li><b>Data da Atividade: </b> {{ date("d/m/Y", strtotime($activity->beginning_datetime)) }}</li>
	<li><b>Horário: </b>{{ date("H:i", strtotime($activity->beginning_datetime)) }} - {{ date("H:i", strtotime($activity->end_datetime)) }}</li>
	<li><b>Capacidade: </b> {{ $activity->maximum_capacity }}</li>
	<li><b>Local: </b> {{ $activity->place }}</li>
</ul>
<b>O Que Será Abordado?</b>
<p>{{ $activity->description }}</p>

<b>Mapa do Local:</b><br>

<iframe width="400" height="300" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q={{ $activity->place }}&key=googleapikey"> </iframe><br>

@forelse($subscriptions as $subscription)
@if($subscription->activity_id == $activity->id)
{{ Form::open(['route'=>['subscriptions.destroy',$subscription->id], 'method' => 'DELETE', 'onsubmit' => 'deleteConfirmation();']) }}
{{ Form::submit('Cancelar Inscrição', ['class' => 'btn btn-outline-danger']) }}
<a href="#" onclick="history.back();" class="btn btn-outline-secondary"> Voltar</a>
{{ Form::close() }}
@else
{{ Form::open(['action' => 'SubscriptionController@store']) }}
{{ Form::hidden('activity_id', $activity->id) }}
{{ Form::submit('Inscreva-se', ['class' => 'btn btn-outline-success']) }}
<a href="#" onclick="history.back();" class="btn btn-outline-secondary"> Voltar</a>
{{ Form::close() }}
@endif
@empty
{{ Form::open(['action' => 'SubscriptionController@store']) }}
{{ Form::hidden('activity_id', $activity->id) }}
{{ Form::submit('Inscreva-se', ['class' => 'btn btn-outline-success']) }}
<a href="#" onclick="history.back();" class="btn btn-outline-secondary"> Voltar</a>
{{ Form::close() }}
@endforelse

<br>
@if(session()->has('sucess'))
<div class="alert alert-danger">
	{{ session()->get('sucess') }}
</div>
@elseif(session()->has('subscriber'))
<div class="alert alert-success">
	{{ session()->get('subscriber') }}
</div>
@endif

@endsection
