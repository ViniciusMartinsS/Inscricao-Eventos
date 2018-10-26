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

<iframe width="400" height="300" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/search?q={{ $activity->place }}&key=AIzaSyCcZZ8U-w804ErGYMZKE7ADdW-WcEzwKak"> </iframe>    

{{ Form::open(['action' => 'SubscriptionController@store']) }}
{{ Form::hidden('user_id', '3') }}
{{ Form::hidden('activity_id', $activity->id) }}
<td>{{ Form::submit('Inscreva-se', ['class' => 'btn btn-outline-success']) }}</td>
<a href="#" onclick="history.back();" class="btn btn-outline-secondary"> Voltar</a>
{{ Form::close() }}



@endsection
