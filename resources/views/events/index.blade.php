@extends('layouts.app')
@section('title', 'Alterar evento')
@section('content')

<div id="events">
	<h3>Eventos Disponíveis</h3>
	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a class="nav-link active" href="#">Eventos</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="#" onclick="escondeEvent();">Minha Lista de Atividades</a>
		</li>
	</ul>
	<table class="table">
		<thead class="thead-dark">
			<tr>
				<th scope="col" style="text-align: center;">#</th>
				<th scope="col" style="text-align: center;">Nome</th>
				<th scope="col" style="text-align: center;">Descrição</th>
				<th scope="col" style="text-align: center;">Data de Início</th>
				<th scope="col" style="text-align: center;">Data Término</th>
				<th scope="col" style="text-align: center;">Ver</th>
			</tr>
		</thead>
		<tbody>
			@forelse ($events as $event)
			<tr>
				<th scope="row">{{ $event->id }}</th>
				<td>{{ $event->name }}</td>
				<td>{{ $event->description }}</td>
				<td>{{ date("d/m/Y", strtotime($event->beginning_date)) }}</td>
				<td>{{ date("d/m/Y", strtotime($event->end_date)) }}</td>
				<td><a href="http://localhost:8080/events/{{$event->id}}" style="font-weight: bold;">Atividades</a></td>
			</tr>
			@empty
			<h5 style="color: red;">Não Possui Registros Cadastrados!</h5>
			@endforelse
		</tbody>
	</table>

	{!! $events->links() !!}
</div>

<div id="subscriptions" style="display: none;">
	<h3>Minha Lista de Atividades</h3>
	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a class="nav-link" href="#" onclick="escondeSubscription();">Eventos</a>
		</li>
		<li class="nav-item">
			<a class="nav-link active" href="#" >Minha Lista de Atividades</a>
		</li>
	</ul>
	<table class="table">
		
		<thead class="thead-dark">
			<tr>
				<th scope="col" style="text-align: center;">#</th>
				<th scope="col" style="text-align: center;">Evento</th>
				<th scope="col" style="text-align: center;">Atividade</th>
				<th scope="col" style="text-align: center;">Data de Início</th>
				<th scope="col" style="text-align: center;">Data Término</th>
				<th scope="col" style="text-align: center;">Lugar</th>
				<th scope="col" style="text-align: center;">Check-In</th>
				<th scope="col" style="text-align: center;">Certificado</th>
				<th scope="col" style="text-align: center;">Ver Mais</th>
				<th scope="col" style="text-align: center;">Inscrição</th>
			</tr>
		</thead>
		<tbody>
			@forelse ($subscriptions as $subscription)
			<tr>
				<th scope="row">{{ $subscription->id }}</th>
				<td style="text-align: center;">{{ $subscription->activity->event->name }}</td>
				<td style="text-align: center;">{{ $subscription->activity->name }}</td>
				<td style="text-align: center;">{{ date("d/m/Y H:i", strtotime($subscription->activity->beginning_datetime)) }}</td>
				<td style="text-align: center;">{{ date("d/m/Y H:i", strtotime($subscription->activity->end_datetime)) }}</td>
				<td style="text-align: center;">{{ $subscription->activity->place}}</td>
				<td style="text-align: center; color: red">{{  $subscription->activity->check_in == 1 ? "Realizado" : "Não Realizado" }}</td>
				<td style="text-align: center;"><button class="btn btn-outline-info" disabled title="Check-in deve ser realizado!">Emitir</button></td>
				<td style="text-align: center;"><a href="http://localhost:8080/activities/{{$subscription->activity->id}}">Ir para Atividade</a></td>
				{{ Form::open(['route'=>['subscriptions.destroy',$subscription->id], 'method' => 'DELETE', 'onsubmit' => 'deleteConfirmation();']) }}
				<td>{{ Form::submit('Cancelar', ['class' => 'btn btn-outline-danger']) }}</td>
				{{ Form::close() }}
			</tr>
			@empty
			<h5 style="color: red;">Não Possui Registros Cadastrados!</h5>
			@endforelse
		</tbody>
	</table>

</div>

@endsection