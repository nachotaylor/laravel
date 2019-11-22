@extends('layout')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h1 class="card-title">
                                Usuarios
                            </h1>
                        </div>
                        @if(Session::has('message'))
                            <div class="card-body">
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
                                    </button>
                                    {{ Session::get('message') }}
                                </div>
                            </div>
                        @endif
                        @if(Session::has('error'))
                            <div class="card-body">
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
                                    </button>
                                    {{ Session::get('error') }}
                                </div>
                            </div>
                        @endif
                        <div class="card-body">
                            <table id="table" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Tipo</th>
                                    <th>Teléfono</th>
                                    <th>Dirección</th>
                                    <th>Detalle</th>
                                    <th>Eliminar</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->type }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td>
                                            <button class="btn bg-transparent"><i class="fa fa-edit text-info" data-toggle="modal" data-target="#edit{{ $user->id }}"></i></button>
                                        </td>
                                        <td>
                                            <button class="btn bg-transparent"><i class="fa fa-trash text-red" data-toggle="modal" data-target="#delete{{ $user->id }}"></i></button>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="edit{{ $user->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-info">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Editar usuario</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                {!! Form::model($user, ['route' => ['admin::update', $user,], 'method' => 'PUT']) !!}
                                                <div class="modal-body">
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    {!! Form::label('name','Nombre',['class' => 'control-label']) !!}
                                                                </div>
                                                                <div class="col-md-8">
                                                                    {!! Form::text('name',null,['class' => 'form-control', 'required']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    {!! Form::label('password','Contraseña',['class' => 'control-label']) !!}
                                                                </div>
                                                                <div class="col-md-8">
                                                                    {!! Form::password('password', ['class' => 'form-control', 'required']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    {!! Form::label('email','E-mail',['class' => 'control-label']) !!}
                                                                </div>
                                                                <div class="col-md-8">
                                                                    {!! Form::text('email',null,['class' => 'form-control', 'required']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    {!! Form::label('phone','Teléfono',['class' => 'control-label']) !!}
                                                                </div>
                                                                <div class="col-md-8">
                                                                    {!! Form::text('phone',null,['class' => 'form-control']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    {!! Form::label('address','Dirección',['class' => 'control-label']) !!}
                                                                </div>
                                                                <div class="col-md-8">
                                                                    {!! Form::text('address',null,['class' => 'form-control']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default pull-left"
                                                            data-dismiss="modal">
                                                        Cerrar
                                                    </button>
                                                    {!! Form::submit('Modificar',['class' => 'btn btn-primary']) !!}
                                                </div>
                                                {!! Form::close() !!}
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>

                                    <div class="modal fade" id="delete{{ $user->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content bg-danger">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Eliminar</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Desea eliminar el usuario {{ $user->name }}?</p>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-outline-light"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                    {!! Form::model($user, ['route' => ['admin::delete', $user], 'method' => 'DELETE']) !!}
                                                    {!! Form::submit('Eliminar',['class' => 'btn btn-outline-light']) !!}
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="card-body">
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#new-user">
                                Nuevo
                            </button>
                        </div>

                        <div class="modal fade" id="new-user">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Nuevo usuario</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    {!! Form::open((['route' => 'admin::create', 'method' => 'POST'])) !!}
                                    <div class="modal-body">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        {!! Form::label('name','Nombre',['class' => 'control-label']) !!}
                                                    </div>
                                                    <div class="col-md-8">
                                                        {!! Form::text('name',null,['class' => 'form-control', 'required']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        {!! Form::label('password','Contraseña',['class' => 'control-label']) !!}
                                                    </div>
                                                    <div class="col-md-8">
                                                        {!! Form::password('password', ['class' => 'form-control', 'required']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        {!! Form::label('email','E-mail',['class' => 'control-label']) !!}
                                                    </div>
                                                    <div class="col-md-8">
                                                        {!! Form::text('email',null,['class' => 'form-control', 'required']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        {!! Form::label('phone','Teléfono',['class' => 'control-label']) !!}
                                                    </div>
                                                    <div class="col-md-8">
                                                        {!! Form::text('phone',null,['class' => 'form-control', 'required']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        {!! Form::label('address','Dirección',['class' => 'control-label']) !!}
                                                    </div>
                                                    <div class="col-md-8">
                                                        {!! Form::text('address',null,['class' => 'form-control', 'required']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">
                                            Cerrar
                                        </button>
                                        {!! Form::submit('Agregar',['class' => 'btn btn-primary']) !!}
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop