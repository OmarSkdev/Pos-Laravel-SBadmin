@extends('template')

@section('title','Crear Compra')
@push('css')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
@endpush


@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Crear Compra</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('compras.index') }}">Compra</a></li>
        <li class="breadcrumb-item active">Crear Compra</li>
    </ol>
</div>
<form action="" method="POST">
    @csrf
    <div class="container mt-4">
        <div class="row gy-4">
            {{-- COMPRA PRODUCTO --}}
            <div class="col-md-8">
                <div class="text-white bg-primary p-1 text-center">
                    Detalles de Compra
                </div>
                <div class="p-3 border border-3 border-primary">

                </div>

            </div>
            <div class="col-md-4">
                <div class="text-white bg-success p-1 text-center">
                    Datos Generales
                </div>
                <div class="p-3 border border-3 border-success">
                    <div class="row">
                        {{-- PROVEEDOR --}}
                        <div class="col-md-12 mb-2">
                            <label for="proveedore_id" class="form-label">Proveedor:</label>
                            <select name="proveedore_id" id="proveedore_id" class="form-control selectpicker show-tick" data-live-search="true" title="Selecciona" data-size='2'>
                                @foreach ($proveedores as $item)
                                    <option value="{{$item->id}}">{{$item->persona->razon_social}}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- Tipo Comprobante --}}
                        <div class="col-12 mb-2">
                            <label for="comprobante_id" class="form-label">Comprobante:</label>
                            <select name="comprobante_id" id="comprobante_id" class="form-control selectpicker" title="Selecciona">
                                @foreach ($comprobantes as $item)
                                <option value="{{$item->id}}">{{$item->tipo_comprobante}}</option>
                                @endforeach
                            </select>
                            @error('comprobante_id')
                            <small class="text-danger">{{ '*'.$message }}</small>
                            @enderror
                        </div>

                        <!--Numero de comprobante-->
                        <div class="col-12 mb-2">
                            <label for="numero_comprobante" class="form-label">Numero de comprobante:</label>
                            <input required type="text" name="numero_comprobante" id="numero_comprobante" class="form-control">
                            @error('numero_comprobante')
                            <small class="text-danger">{{ '*'.$message }}</small>
                            @enderror
                        </div>

                        <!--Impuesto-->
                        <div class="col-md-6 mb-2">
                            <label for="impuesto" class="form-label">Impuesto:</label>
                            <input readonly type="text" name="impuesto" id="impuesto" class="form-control border-success">
                            @error('impuesto')
                            <small class="text-danger">{{ '*'.$message }}</small>
                            @enderror
                        </div>
                        <!--Fecha-->
                        <div class="col-md-6 mb-2">
                            <label for="fecha" class="form-label">Fecha:</label>
                            <input readonly type="date" name="fecha" id="fecha" class="form-control border-success" value="<?php echo date("Y-m-d") ?>">
                            @error('impuesto')
                            <small class="text-danger">{{ '*'.$message }}</small>
                            @enderror
                        </div>

                        <!--Botones-->
                        <div class="col-md-12 mb-2 text-center">
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</form>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

@endpush