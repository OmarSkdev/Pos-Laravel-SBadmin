@extends('template')

@section('title', 'Ver compra')

@push('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Ver Venta</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('panel')}}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('ventas.index') }}">Venta</a></li>
        <li class="breadcrumb-item active">Ver Venta</li>
    </ol>
</div>
<div class="container w-100 border border-3 border-primary rounded p-4 mt-3">

    <div class="row mb-2">
        <div class="col-sm-3">
            <div class="input-group" id="hide-group">
                <span class="input-group-text"><i class="fas fa-file"></i></span>
                <input disabled type="text" class="form-control" value="Tipo de comprobante: ">
            </div>
        </div>
    
        <div class="col-sm-9">
            <input disabled type="text" class="form-control" value="{{$venta->comprobante->tipo_comprobante}} ">
        </div>        
    </div>
    <!-- Numero Comprobante-->
    <div class="row mb-2">
        <div class="col-sm-3">
            <div class="input-group" id="hide-group">
                <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                <input disabled type="text" class="form-control" value="Número de comprobante: ">
            </div>
        </div>
    
        <div class="col-sm-9">
            <input disabled type="text" class="form-control" value="{{$venta->numero_comprobante}} ">
        </div>        
    </div>
    <!-- Cliente-->
    <div class="row mb-2">
        <div class="col-sm-4">
            <div class="input-group" id="hide-group">
                <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                <input disabled type="text" class="form-control" value="Cliente: ">
            </div>
        </div>
    
        <div class="col-sm-8">
            <input disabled type="text" class="form-control" value="{{$venta->cliente->persona->razon_social}} ">
        </div>        
    </div>

    <!--Fecha-->
    <div class="row mb-2">
        <div class="col-sm-4">
            <div class="input-group" id="hide-group">
                <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                <input disabled type="text" class="form-control" value="Fecha: ">
            </div>
        </div>
    
        <div class="col-sm-8">
            <input disabled type="text" class="form-control" value="{{ \Carbon\Carbon::parse($venta->fecha_hora)->format('d-m-Y') }} ">
        </div>        
    </div>

    <!---Hora-->
    <div class="row mb-2">
        <div class="col-sm-4">
            <div class="input-group" id="hide-group">
                <span class="input-group-text"><i class="fas fa-clock"></i></span>
                <input disabled type="text" class="form-control" value="Hora: ">
            </div>
        </div>
        <div class="col-sm-8">
            <div class="input-group">
                <span title="Hora" id="icon-form" class="input-group-text"><i class="fas fa-clock"></i></span>
                <input disabled type="text" class="form-control" value="{{ \Carbon\Carbon::parse($venta->fecha_hora)->format('H:i') }}">
            </div>
        </div>
    </div>

    <!--Impuesto-->
    <div class="row mb-2">
        <div class="col-sm-4">
            <div class="input-group" id="hide-group">
                <span class="input-group-text"><i class="fas fa-percent"></i></span>
                <input disabled type="text" class="form-control" value="Impuesto: ">
            </div>
        </div>
    
        <div class="col-sm-8">
            <input id="input-impuesto" disabled type="text" class="form-control" value="{{ $venta->impuesto }} ">
        </div>        
    </div>

    <!--Tabla-->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Tabla de Detalle de la Venta
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio de Venta</th>
                        <th>Descuento</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($venta->productos as $item )
                        <tr>
                            <td>{{ $item->nombre}}</td>
                            <td>{{ $item->pivot->cantidad}}</td>
                            <td>{{ $item->pivot->precio_venta}}</td>
                            <td>{{ $item->pivot->descuento}}</td>
                            <td class="td-subtotal">{{ ($item->pivot->cantidad) *  ($item->pivot->precio_venta) - ($item->pivot->descuento)}}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5"></th>
                    </tr>
                    <tr>
                        <th colspan="4">Sumas:</th>
                        <th id="th_suma"></th>
                    </tr>
                    <tr>
                        <th colspan="4">IVA:</th>
                        <th id="th_iva"></th>
                    </tr>
                    <tr>
                        <th colspan="4">Total:</th>
                        <th id="th_total"></th>
                    </tr>
                </tfoot>

            </table>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    //Variables
    let filasSubtotal = document.getElementsByClassName('td-subtotal');
    let cont = 0;
    let impuesto = $('#input-impuesto').val();

    $(document).ready(function() {
        calcularValores();
    });

    function calcularValores() {
        for (let i=0; i < filasSubtotal.length; i++) {
            cont += parseFloat(filasSubtotal[i].innerHTML)
        }

        $('#th_suma').html(cont);
        $('#th_iva').html(impuesto);
        $('#th_total').html(cont + parseFloat(impuesto));
    }
</script>    
@endpush