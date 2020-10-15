@php $nameObj = "Departamento"; @endphp
@extends('layouts.show_large')
@section('title_page', 'Estadísticas '.$nameObj)
@section('text_title', 'Estadísticas '.$nameObj)
@section('page_metas') @endsection
@push('page_import_css') @endpush
@push('page_style_css') @endpush
@section('breadcrumbs') {{
    Breadcrumbs::render(strtolower($nameObj).'.statistics') }}
@endsection
@section('page_sub_title_bar')
    <x-banners.bg_image_head title="Estadísticas " subtitle="Gráficos" :link="URL::route(strtolower($nameObj).'.create')" txtButton="Crear" iconButton="fa fa-plus" />
@endsection

@section('full_content')
    <x-block_tabs id="blockInfo{{$nameObj}}"
        :tabs="[['id'=>'tabInfo'.$nameObj,'name'=>'Gráficos Generales']]" >
        <x-slot name="content">
            <div class="tab-pane active" id="tabInfo{{$nameObj}}" role="tabpanel">
                <div class="row">
                    <x-block_graphic class="col-sm-12 col-md-4" title="Departamentos por Region" >
                        <x-slot name="content"> {!! $chartRegion->container() !!} </x-slot>
                    </x-block_graphic>

                    <x-block_graphic class="col-sm-12 col-md-4" title="Departamentos Registrados" >
                        <x-slot name="content">  {!! $chartRegistros->container() !!} </x-slot>
                    </x-block_graphic>

                    <x-block_graphic class="col-sm-12 col-md-4" title="Estado Departamentos" >
                        <x-slot name="content">  {!! $chartEstado->container() !!} </x-slot>
                    </x-block_graphic>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <div class="row">
                <div class="col-6 font-size-sm text-left">
                    {{ Form::eButtonLink('btnBack', 'Regresar', [ 'href' => route(strtolower($nameObj).'.index'), 'class' => 'btn-hero-primary btn-hero-sm mb-1', 'icon' => 'fa fa-arrow-left' ]) }}
                </div>
            </div>
        </x-slot>
    </x-block_tabs>
@endsection

@push('page_import_scripts')
    <script src="{{ asset("js/plugins/chart.js/Chart.bundle.min.js") }}"></script>
@endpush
@push('page_after_js')
    {!! $chartRegistros->script() !!}
    {!! $chartRegion->script() !!}
    {!! $chartEstado->script() !!}
@endpush
