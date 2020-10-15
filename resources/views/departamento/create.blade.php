@php $nameObj = "Departamento"; @endphp
@extends('layouts.create')
@section('title_page', 'Crear '.$nameObj)
@section('text_title', 'Crear '.$nameObj)
@section('page_metas') @endsection
@push('page_import_css') @endpush
@push('page_style_css') @endpush
@section('breadcrumbs')
    {{ Breadcrumbs::render( strtolower($nameObj).'.create') }}
@endsection

@section('page_content')
    {!! Form::model($departamento, [
        'id' => 'frmCreate'.$nameObj,
        'name' => 'frmCreate'.$nameObj,
        'action' => $nameObj.'Controller@store',
        'class' => 'mb-5'
    ]) !!}
    <x-block_tabs id="blockCreate{{$nameObj}}" typeBlock="Simple" :tabs="[['id'=>'tabReg'.$nameObj,'name'=>'Registrar '.$nameObj]]" >
        <x-slot name="content">
            <div class="tab-pane active" id="tabReg{{$nameObj}}" role="tabpanel">
                @if ($errors->any())
                    <x-alerts.large_title typeAlert="danger" validation="true" :errors="$errors" />
                @endif
                <!-- Horizontal Layout -->
                <div class="row">
                    <div class="col-lg-3 col-xl-3">
                        <p class="text-muted">
                            Ingrese la información correspondiente al {{strtolower($nameObj)}}.
                        </p>
                    </div>
                    <div class="col-lg-9 col-xl-6">
                        {{ Form::eNumber('id', 'Código Dane', ['step' =>'1', 'max' => 99, 'min' => 5, 'maxlength' => 3, 'minlength' => 1, 'required' => 'required' ,'placeholder' => 'Ejm: 15', 'value' => old('id')]) }}
                        {{ Form::eText('nombre', 'Nombre', ['maxlength' => 30, 'minlength' => 5, 'required' => 'required' ,'placeholder' => 'Ejm: MiDepartamento', 'style' => "text-transform: uppercase", 'value' => old('nombre')]) }}
                        {{ Form::eSelect2('region', 'Región', \App\Enums\DepartamentoRegion::getValues(), false,
                            ['label'=>true, 'class'=>' '.($errors->has('region') ? 'is-invalid' : ''),
                            'error' => false, 'required'=> true, 'firstElement' => true,
                            'data-placeholder' => 'Seleccione la Región', 'labelConfirm' => true,
                            'value'=> old('region') ]) }}

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
