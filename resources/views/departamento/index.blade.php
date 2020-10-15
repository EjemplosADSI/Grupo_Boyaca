@php $nameObj = "Departamentos"; $singNameObj = "Departamento"; @endphp

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Grupo Boyacá</h1>
@stop

@section('content')
    <p>Gestionar Departamentos.</p>
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Departamentos</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="card-body">
            {{ $dataTable->table([],true) }}
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            Footer
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
@stop

@section('footer')
    .
@stop

@section('css')

@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
@section('plugins.Datatables', true)
