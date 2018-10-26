@extends('layouts.app')
@section('title', 'Painel de Controle - Restrito')

@section('content')
<h3>Atividades Disponíveis</h3>
<ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link active" href="#">Atividades - {{$activities[0]->event->name}}</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="http://localhost:8080/events">Voltar Eventos</a>
    </li>
  </ul>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col" style="text-align: center;">#</th>
      <th scope="col" style="text-align: center;">Nome</th>
      <th scope="col" style="text-align: center;">Descrição</th>
      <th scope="col" style="text-align: center;">Data </th>
      <th scope="col" style="text-align: center;">Horário Início</th>
      <th scope="col" style="text-align: center;">Horário Término</th>
      <th scope="col" style="text-align: center;">Capacidade Máxima</th>
      <th scope="col" style="text-align: center;">Total de Inscrições</th>
      <th scope="col" style="text-align: center;">Vagas Disponiveis</th>
      <th scope="col" style="text-align: center;">Sobre a Atividade</th>
      <th style="text-align: center;">Inscrição</th>
    </tr>
  </thead>
  <tbody>
    @forelse($activities as $activity)
    <tr>
      <th scope="row">{{ $activity->id }}</th>
      <td style="text-align: center;">{{ $activity->name }}</td>
      <td style="text-align: center;">{{ $activity->description }}</td>
      <td style="text-align: center;">{{ date("d/m/Y", strtotime($activity->beginning_datetime)) }}</td>
      <td style="text-align: center;">{{ date("H:i", strtotime($activity->beginning_datetime)) }}</td>
      <td style="text-align: center;">{{ date("H:i", strtotime($activity->end_datetime)) }}</td>
      <td style="text-align: center;">{{ $activity->maximum_capacity }}</td>
      <td style="text-align: center;">15</td>
      <td style="text-align: center;">0</td>
      <td style="text-align: center;"><a href="http://localhost:8080/activities/{{$activity->id}}" >Ver Mais</a></td>
      {{ Form::open(['action' => 'SubscriptionController@store']) }}
      {{ Form::hidden('user_id', '3') }}
      {{ Form::hidden('activity_id', $activity->id) }}
      <td>{{ Form::submit('Inscreva-se', ['class' => 'btn btn-outline-success']) }}</td>
      {{ Form::close() }}
      @empty
      @endforelse
    </tbody>
  </table>

  @endsection