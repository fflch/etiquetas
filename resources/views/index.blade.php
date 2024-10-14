@extends('laravel-usp-theme::master')
@section('content')

@section('title') Etiquetas PIMACO  @endsection

@include('flash')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <b>Fazer upload de arquivo csv</b>
                </div>
                <div class="card-body">
                    <form method="post" action="/gera-pdf" enctype="multipart/form-data">
                        @csrf
                    <div class="row">
                        <div class="col">
                            <input id="file" name="file" type="file" style="margin-bottom:10px;" />
                        </div>
                        <div class="col-8">
                            <label>Escolha o tipo de etiqueta</label>
                            <select class="form-control" name="etiqueta" style="width:50%;">
                                @foreach($etiquetas::etiquetaOptions() as $etiqueta)
                                <option value="{{$etiqueta}}">{{$etiqueta}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col" style="margin-top:-50px;">
                            <b>Alinhamento: </b><br/>
                            <input type="radio" name="alignment" value="left" checked>
                            <label>À Esquerda</label><br>
                            <input type="radio" name="alignment" value="right">
                            <label>À direita</label><br>
                            <input type="radio" name="alignment" value="center">
                            <label>Centralizado</label>
                        </div>
                    </div>
                    <hr />
                    
                    <div class="row">
                        <div class="col">
                            <label style="margin-top:10px; margin-bottom:-20px;">Margem esquerda</label>
                            <input type="number" name="mesq" class="form-control">
                        </div>
                        <div class="col">
                            <label style="margin-top:10px; margin-bottom:-20px;">Margem direita</label>
                            <input type="number" name="mdir" class="form-control">
                        </div>
                        <div class="col">
                            <label style="margin-top:10px; margin-bottom:-20px;">Margem superior</label>
                            <input type="number" name="msup" class="form-control">
                        </div>
                        <div class="col">
                            <label style="margin-top:10px; margin-bottom:-20px;">Margem inferior</label>
                            <input type="number" name="minf" class="form-control">
                        </div>
                    </div>

                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-8">
                                @can('is_user')
                                <button class="btn btn-success" type="submit">
                                    Enviar
                                </button>
                                @endcan
                            </div>
                            <div class="col-4">
                            <a href="/download" class="btn btn-outline-primary">
                                Download do modelo CSV <i class="fa fa-download"></i>
                            </a>
                            </div>
                        </div>
                    </li>
                </form>
                </ul>
            </div>
        </div>
    </div>
</div>
<style>
    @media(max-width: 1199px){
        .col-2{
            padding-right:0px !important;
        }
    }
    @media(max-width:991px){
        .col-2{
            max-width:102% !important;
        }
    }
</style>

@endsection