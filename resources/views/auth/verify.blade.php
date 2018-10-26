@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifique Sua Conta!') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Um novo link de verificação foi enviado ao seu email.') }}
                        </div>
                    @endif

                    {{ __('Antes de continuar, por favor verifique sua conta. Um link de validação foi enviado ao seu email.') }}
                    {{ __('Caso não tenha recebido o email') }}, <a href="{{ route('verification.resend') }}">{{ __('Clique aqui para ser reenviado') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
