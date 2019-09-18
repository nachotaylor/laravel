@extends('layout')

@section('content')
    <div class="table-responsive">
        <div class="col-xs-12 row">
            <div class="box-header">
                <h1 class="box-title">Productores</h1>
            </div>

            @if(Session::has('message'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('message') }}
                </div>
            @endif
            @if(Session::has('error'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('error') }}
                </div>
            @endif

            <div class="box with-border">
                <div class="box-body">
                    <table id="table" class="table table-condensed table-hover dataTable" role="grid"
                           aria-describedby="example1_info" style="overflow-y: auto">
                        <thead>
                        <tr>
                            <th>Cotizaciones</th>
                            <th>Cliente</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($insurances as $insurance)
                            <tr>
                                <td>
                                </td>
                                <td>
                                </td>
                                <td>
                                <td>
                                    <a class="btn btn-primary" data-toggle="modal"
                                       data-target="#edit{{ $insurance->id }}"><i class="fa fa-edit"></i></a>
                                </td>
                                <td>
                                    <a type="button" class="btn btn-danger" data-toggle="modal"
                                       data-target="#modal-danger{{ $insurance->id }}"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>

                            <div class="modal fade in" id="edit{{ $insurance->id }}">
                                <div class="modal-dialog modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span></button>
                                        <h4 class="modal-title">Editar póliza</h4>
                                    </div>
                                    {!! Form::model($insurance, ['route' => ['producer::update', $insurance], 'method' => 'PUT']) !!}
                                    <div class="modal-body box-body">
                                        <div class="form-group">
                                            {!! Form::label('insurance','Póliza',['class' => 'control-label']) !!}
                                            {!! Form::text('insurance',null,['class' => 'form-control', 'required']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('client','Cliente',['class' => 'control-label']) !!}
                                            {!! Form::text('client',null,['class' => 'form-control', 'required']) !!}
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default pull-left"
                                                data-dismiss="modal">Cerrar
                                        </button>
                                        {!! Form::submit('Actualizar',['class' => 'btn btn-primary']) !!}
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>

                            <div class="modal modal-danger fade" id="modal-danger{{ $insurance->id }}"
                                 style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">×</span></button>
                                            <h4 class="modal-title">Delete</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Desea eliminar {{ $insurance->id }}?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline pull-left"
                                                    data-dismiss="modal">Cerrar
                                            </button>
                                            {!! Form::model($insurance, ['route' => ['producer::delete', $insurance], 'method' => 'DELETE']) !!}
                                            {!! Form::submit('Eliminar',['class' => 'btn btn-outline']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        @endforeach
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuevo-packaging"><i
                    class="fa fa-plus"></i> Nuevo</a>

        <div class="modal fade in" id="nuevo-packaging">
            <div class="modal-dialog modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Nuevo cotización</h4>
                </div>
                {!! Form::open((['route' => 'producer::create', 'method' => 'POST'])) !!}
                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('name','Nombre',['class' => 'control-label']) !!}
                            {!! Form::text('name',null,['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('enrollment','Matrícula',['class' => 'control-label']) !!}
                            {!! Form::text('enrollment',null,['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('password','Contraseña',['class' => 'control-label']) !!}
                            {!! Form::password('password', ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('email','E-mail',['class' => 'control-label']) !!}
                            {!! Form::text('email',null,['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('phone','Teléfono',['class' => 'control-label']) !!}
                            {!! Form::text('phone',null,['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('address','Dirección',['class' => 'control-label']) !!}
                            {!! Form::text('address',null,['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar
                    </button>
                    {!! Form::submit('Agregar',['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>

    </div>
@stop