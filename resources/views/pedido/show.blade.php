@extends('layouts.app')

@section('template_title')
    {{ $pedido->name ?? "{{ __('Show') Pedido" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Pedido</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('pedidos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Idproducto:</strong>
                            {{ $pedido->idproducto }}
                        </div>
                        <div class="form-group">
                            <strong>Cantidad:</strong>
                            {{ $pedido->cantidad }}
                        </div>
                        <div class="form-group">
                            <strong>Precio Unitario:</strong>
                            {{ $pedido->precio_unitario }}
                        </div>
                        <div class="form-group">
                            <strong>Precio Total:</strong>
                            {{ $pedido->precio_total }}
                        </div>
                        <div class="form-group">
                            <strong>Estatus:</strong>
                            {{ $pedido->estatus }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
