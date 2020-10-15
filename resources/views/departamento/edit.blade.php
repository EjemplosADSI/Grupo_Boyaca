@php $nameObj = "Departamento"; @endphp
@extends('layouts.create')
@section('title_page', 'Modificar '.$nameObj)
@section('text_title', 'Modificar '.$nameObj)
@section('page_metas') @endsection
@push('page_import_css') @endpush
@push('page_style_css') @endpush
@section('breadcrumbs') {{
    Breadcrumbs::render(strtolower($nameObj).'.edit', $departamento) }}
@endsection

@section('page_content')
    {!! Form::model($departamento, [
        'id' => 'frmEdit'.$nameObj,
        'name' => 'frmEdit'.$nameObj,
        'action' => [$nameObj.'Controller@update', $departamento->id],
        'class' => 'mb-5'
        ]) !!}
    {{ method_field('PATCH') }}
    <x-block_tabs id="blockEdit{{$nameObj}}" typeBlock="Simple" :tabs="[['id'=>'tabEdit'.$nameObj,'name'=>'Modificar '.$nameObj]]" >
        <x-slot name="content">
            <div class="tab-pane active" id="tabEdit{{$nameObj}}" role="tabpanel">
                @if ($errors->any())
                    <x-alerts.large_title typeAlert="danger" validation="true" :errors="$errors" />
                @endif
                <!-- Horizontal Layout -->
                <div class="row">
                    <div class="col-lg-3 col-xl-3">
                        <p class="text-muted">
                            Actualice la información correspondiente al {{strtolower($nameObj)}}.
                        </p>
                    </div>
                    <div class="col-lg-9 col-xl-6">
                        {{ Form::eNumber('id', 'Código Dane', ['step' =>'1', 'max' => 99, 'min' => 5, 'maxlength' => 3, 'minlength' => 1, 'required' => 'required' ,'placeholder' => 'Ejm: 15', 'value' => (!empty(old('id'))) ? old('id') : $departamento->id, 'onlyText' => true]) }}
                        {{ Form::eText('nombre', 'Nombre', ['maxlength' => 30, 'minlength' => 5, 'required' => 'required' ,'placeholder' => 'Ejm: MiDepartamento', 'style' => "text-transform: uppercase", 'value' => (!empty(old('nombre'))) ? old('nombre') : $departamento->nombre]) }}
                        {{ Form::eSelect2('region', 'Región', \App\Enums\DepartamentoRegion::getValues(), false,
                            ['label'=>true, 'class'=>' '.($errors->has('region') ? 'is-invalid' : ''),
                            'error' => false, 'required'=> true, 'firstElement' => true,
                            'data-placeholder' => 'Seleccione la Región', 'labelConfirm' => true,
                            'value'=> (!empty(old('region'))) ? old('region') : $departamento->region ]) }}

                        {{ Form::eSelect2('estado', 'Estado', \App\Enums\BasicStatus::getValues(), false,
                            ['label'=>true, 'class'=>' '.($errors->has('estado') ? 'is-invalid' : ''),
                            'error' => false, 'required'=> true, 'firstElement' => false,
                            'data-placeholder' => 'Seleccione un Estado', 'labelConfirm' => true,
                            'value'=> (!empty(old('estado'))) ? old('estado') : $departamento->estado ]) }}

                    </div>
                </div>
                <!-- END Horizontal Layout -->
            </div>
        </x-slot>
        <x-slot name="footer">
            <div class="container">
                <div class="row justify-content-center">
                    {{ Form::eButtonLink('btnCancel', $nameObj."s", [ 'href' => route(strtolower($nameObj).'.index'), 'class' => 'btn-hero-info btn-hero-sm mb-1', 'icon' => 'fa-arrow-left' ]) }}
                    {{ Form::eButton('btnSend', 'Enviar', [ 'type' => 'submit', 'class' => 'btn-hero-success btn-hero-sm mb-1', 'icon' => 'fa-save' ]) }}
                </div>
            </div>
        </x-slot>
    </x-block_tabs>
    {!! Form::close() !!}
@endsection

@push('page_import_scripts') @endpush
@push('page_after_js') @endpush
