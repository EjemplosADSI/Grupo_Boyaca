@php $nameObj = "Departamento"; @endphp
@extends('layouts.show_large')
@section('title_page', 'Ver '.$nameObj)
@section('text_title', 'Ver '.$nameObj)
@section('page_metas') @endsection
@push('page_import_css') @endpush
@push('page_style_css') @endpush
@section('breadcrumbs') {{
    Breadcrumbs::render(strtolower($nameObj).'.show', $departamento) }}
@endsection
@section('page_sub_title_bar')
    <x-banners.bg_image_head :title="$departamento->nombre" subtitle="detalles" :link="URL::route(strtolower($nameObj).'.edit',$departamento)" />
@endsection

@section('full_content')
    <x-block_tabs id="blockInfo{{$nameObj}}"
        :tabs="[['id'=>'tabInfo'.$nameObj,'name'=>'Inf. General '.$nameObj], ['id'=>'tabInfoMun'.$nameObj,'name'=>'Municipios '.$nameObj]]" >
        <x-slot name="content">
            <div class="tab-pane active" id="tabInfo{{$nameObj}}" role="tabpanel">
                <table class="table table-sm table-vcenter">
                    <tbody>
                    <tr>
                        <th class="text-left">Codigo DANE</th>
                        <td class="font-w600">{{ $departamento->id }}</td>
                    </tr>
                    <tr>
                        <th class="text-left">Nombre</th>
                        <td class="font-w600">{{ $departamento->nombre }}</td>
                    </tr>
                    <tr>
                        <th class="text-left">Region</th>
                        <td class="font-w600">{{ $departamento->region }}</td>
                    </tr>
                    <tr>
                        <th class="text-left">Estado</th>
                        <td class="font-w600">{{ $departamento->estado }}</td>
                    </tr>
                    <tr>
                        <th class="text-left">Creacion</th>
                        <td class="font-w600">{{ $departamento->created_at }}</td>
                    </tr>
                    <tr>
                        <th class="text-left">Actualizacion</th>
                        <td class="font-w600">{{ $departamento->updated_at }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="tabInfoMun{{$nameObj}}" role="tabpanel">
                {{ $dataTable->table([],true) }}
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

@push('page_import_scripts') @endpush
@push('page_after_js')
    {!! $dataTable->scripts() !!}
@endpush
