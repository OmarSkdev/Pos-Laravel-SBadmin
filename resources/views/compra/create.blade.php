@extends('template')

@section('title','Crear Compra')
@push('css')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
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
<form action="{{ route('compras.store')}}" method="POST">
    @csrf
    <div class="container mt-4">
        <div class="row gy-4">
            {{-- COMPRA PRODUCTO --}}
            <div class="col-md-8">
                <div class="text-white bg-primary p-1 text-center">
                    Detalles de Compra
                </div>
                <div class="p-3 border border-3 border-primary">
                    <div class="row">
                        {{-- PRODUCTO --}}
                        <div class="col-md-12 mb-2">
                            <select name="producto_id" id="producto_id" class="form-control selectpicker" data-live-search="true" data-size="1" title="Busque un Producto">
                                @foreach ($productos as $item)
                                    <option value="{{$item->id}}">{{$item->codigo.'  '.$item->nombre}}</option>
                                @endforeach

                            </select>
                        </div>

                        {{-- CANTIDAD --}}
                        <div class="col-md-4 mb-2">
                            <label for="cantidad" class="form-label">Cantidad:</label>
                            <input type="number" name="cantidad" id="cantidad" class="form-control">
                        </div>

                        {{-- Precio de Compra --}}
                        <div class="col-md-4 mb-2">
                            <label for="precio_compra" class="form-label">Precio de Compra:</label>
                            <input type="number" name="precio_compra" id="precio_compra" class="form-control" step="0.1">
                        </div>

                        {{-- Precio de Venta --}}
                        <div class="col-md-4 mb-2">
                            <label for="precio_compra" class="form-label">Precio de Venta:</label>
                            <input type="number" name="precio_venta" id="precio_venta" class="form-control" step="0.1">
                        </div>

                        {{-- Botón para Agregar --}}
                        <div class="col-md-12 mb-2 mt-2 text-end">
                            <button class="btn btn-primary" id="btn_agregar" type="button">Agregar</button>
                        </div>

                        {{-- Tabla para el detalle de la vENTA --}}
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="tabla_detalle" class="table table-hover">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>#</th>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Precio Compra</th>
                                            <th>Precio Venta</th>
                                            <th>Subtotal</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th></th>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th colspan="4">Sumas</th>
                                            <th colspan="2"><span id="sumas">0</span></th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th colspan="4">IVA %</th>
                                            <th colspan="2"><span id="iva">0</span></th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th colspan="4">Total</th>
                                            <th colspan="2"><input type="hidden" name="total" value="0" id="inputTotal"><span id="total">0</span></th>
                                        </tr>
                                    </tfoot>

                                </table>

                            </div>

                        </div>

                        <!--Boton para cancelar compra-->
                        <div class="col-12 mt-2">
                            <button id="cancelar" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Cancelar compra
                            </button>
                        </div>
                    </div>

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
                            @error('proveedor_id')
                                <small class="text-danger">{{'*'.$message }}</small>
                            @enderror
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
                            @error('fecha')
                            <small class="text-danger">{{ '*'.$message }}</small>
                            @enderror
                            <?php
                            use Carbon\Carbon;
                            $fecha_hora = Carbon::now()->toDateTimeString();
                            ?>
                            <input type="hidden" name="fecha_hora" value="{{$fecha_hora}}">
                        </div>

                        <!--Botones-->
                        <div class="col-md-12 mt-4 text-center">
                            <button class="btn btn-success" type="submit" id="guardar">Guardar Compra</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- Modal para cancelar la compra -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Advertencia</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Seguro que quieres cancelar la compra?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button id="btnCancelarCompra" type="button" class="btn btn-danger" data-bs-dismiss="modal">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

</form>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<script>
    $(document).ready(function(){
        $('#btn_agregar').click(function(){
            agregarProducto();
        });

        $('#btnCancelarCompra').click(function() {
            cancelarCompra();
        });

        disableButtons();
        
        $('#impuesto').val(impuesto + '%')
    });

    //VARIABLES
    let cont = 0;
    let subtotal = [];
    let sumas = 0;
    let iva = 0;
    let total = 0;

    //CONSTANTES
    const impuesto = 19;

    function cancelarCompra(){
        $('#tabla_detalle > tbody').empty();

        //Añadir una nueva fila a la tabla
        let fila = '<tr>' +
            '<th></th>' +
            '<td></td>' +
            '<td></td>' +
            '<td></td>' +
            '<td></td>' +
            '<td></td>' +
            '<td></td>' +
            '</tr>';
        $('#tabla_detalle').append(fila);

         //Reiniciar valores de las variables
        cont = 0;
        subtotal = [];
        sumas = 0;
        iva = 0;
        total = 0;

        //Mostrar los campos calculados
        $('#sumas').html(sumas);
        $('#iva').html(iva);
        $('#total').html(total);
        $('#impuesto').val(impuesto + '%');
        $('#inputTotal').val(total); 

        limpiarCampos();
        disableButtons();

    }

    function disableButtons() {
        if (total == 0) {
            $('#guardar').hide();
            $('#cancelar').hide();
        } else {
            $('#guardar').show();
            $('#cancelar').show();
        }
    }

    function agregarProducto(){
        let idProducto = $('#producto_id').val();
        let nameProducto = ($('#producto_id option:selected').text()).split('  ')[1];
        let cantidad = $('#cantidad').val();
        let precioCompra = $('#precio_compra').val();
        let precioVenta = $('#precio_venta').val();

        //Validaciones
        //1. Para que los campos no esten vacíos
        if (nameProducto != '' && nameProducto != undefined && cantidad != '' && precioCompra != '' && precioVenta != '' ) {
            
            // 2. Validar input cantidad mayor a 0 y es entero. Lo mismo para los otros input pero son decimales
            if (parseInt(cantidad) > 0 && (cantidad % 1 == 0) && parseFloat(precioCompra) > 0 && parseFloat(precioVenta) > 0) {
                
                //3. Para que el precio de compra sea menor que el precio de venta
                if (parseFloat(precioVenta) > parseFloat(precioCompra)) {
                    // Calcular subtotales
                    subtotal[cont] = round(cantidad * precioCompra);
                    sumas += subtotal[cont];
                    iva = round(sumas / 100 * impuesto);
                    total = round(sumas + iva);

                    let fila = '<tr id="fila' + cont + '">' +
                        '<th>' + (cont + 1) + '</th>' +
                        '<td><input type="hidden" name="arrayidproducto[]" value="' + idProducto + '">' + nameProducto + '</td>' +
                        '<td><input type="hidden" name="arraycantidad[]" value="' + cantidad + '">' + cantidad + '</td>' +
                        '<td><input type="hidden" name="arraypreciocompra[]" value="' + precioCompra + '">' + precioCompra + '</td>' +
                        '<td><input type="hidden" name="arrayprecioventa[]" value="' + precioVenta + '">' + precioVenta + '</td>' +
                        '<td>' + subtotal[cont] + '</td>' +
                        '<td><button class="btn btn-danger" type="button" onClick="eliminarProducto('+ cont +')"><i class="fas fa-trash"></i></button></td>' +
                        '</tr>';
        
                    $('#tabla_detalle').append(fila);
                    limpiarCampos();
                    cont++;
                    disableButtons();

                    //Mostrar los campos calculados
                    $('#sumas').html(sumas);
                    $('#iva').html(iva);
                    $('#impuesto').val(iva);
                    $('#total').html(total);
                    $('#inputTotal').val(total);

                } else {
                    showModal('Precio de compra incorrecto');
                }
            } else {
                showModal('Valor incorrectos')
            }   

        } else {
            showModal('Faltan campos por ingresar')
        }
        

    

    }

    function limpiarCampos() {
        let select = $('#producto_id');
        select.selectpicker();
        select.selectpicker('val', '');
        $('#cantidad').val('');
        $('#precio_compra').val('');
        $('#precio_venta').val('');
    }

    function round(num, decimales = 2) {
        var signo = (num >= 0 ? 1 : -1);
        num = num * signo;
        if (decimales === 0) //con 0 decimales
            return signo * Math.round(num);
        // round(x * 10 ^ decimales)
        num = num.toString().split('e');
        num = Math.round(+(num[0] + 'e' + (num[1] ? (+num[1] + decimales) : decimales)));
        // x * 10 ^ (-decimales)
        num = num.toString().split('e');
        return signo * (num[0] + 'e' + (num[1] ? (+num[1] - decimales) : -decimales));
    }
    //Fuente: https://es.stackoverflow.com/questions/48958/redondear-a-dos-decimales-cuando-sea-necesario

    function eliminarProducto(indice) {
        //Calcular valores
        sumas -= round(subtotal[indice]);
        iva = round(sumas / 100 * impuesto);
        total = round(sumas + iva);

        //Mostrar los campos calculados
        $('#sumas').html(sumas);
        $('#iva').html(iva);
        $('#total').html(total);
        $('#impuesto').val(igv);
        $('#InputTotal').val(total); 

        //Eliminar el fila de la tabla
        $('#fila' + indice).remove();
    }

    function showModal(message, icon = 'error') {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: icon,
            title: message
        })
    }
</script>
@endpush