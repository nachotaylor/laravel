@extends('layout')

@section('content')
    <div class="table-responsive">
        <div class="col-xs-12 row">
            <div class="box-header">
                <h1 class="box-title">Users</h1>
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
                            <th>Name</th>
                            <th>E-mail</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    {{$user->name}}
                                </td>
                                <td>
                                    <a href="mailto:{{$user->email}}">{{strlen($user->email) > 36 ? substr($user->email, 0, 32).'...' : $user->email}}</a>
                                </td>
                                <td>
                                    <a class="btn btn-primary" data-toggle="modal"
                                       data-target="#edit{{ $user->id }}"><i class="fa fa-edit"></i></a>
                                </td>
                                <td>
                                    <a type="button" class="btn btn-danger" data-toggle="modal"
                                       data-target="#modal-danger{{ $user->id }}"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>

                            <div class="modal fade in" id="edit{{ $user->id }}">
                                <div class="modal-dialog modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span></button>
                                        <h4 class="modal-title">Editar usuario</h4>
                                    </div>
                                    {!! Form::model($user, ['route' => ['admin::update', $user], 'method' => 'PUT']) !!}
                                    <div class="modal-body box-body">
                                        <div class="form-group">
                                            {!! Form::label('name','Nombre',['class' => 'control-label']) !!}
                                            {!! Form::text('name',null,['class' => 'form-control', 'required']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('email','E-mail',['class' => 'control-label']) !!}
                                            {!! Form::text('email',null,['class' => 'form-control', 'required']) !!}
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

                            <div class="modal modal-danger fade" id="modal-danger{{ $user->id }}"
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
                                            <p>Desea eliminar {{ $user->name }}?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline pull-left"
                                                    data-dismiss="modal">Cerrar
                                            </button>
                                            {!! Form::model($user, ['route' => ['admin::delete', $user], 'method' => 'DELETE']) !!}
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
                    <h4 class="modal-title">Nuevo usuario</h4>
                </div>
                {!! Form::open((['route' => 'admin::create', 'method' => 'POST'])) !!}
                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('name','Nombre',['class' => 'control-label']) !!}
                            {!! Form::text('name', null,['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('email','E-mail',['class' => 'control-label']) !!}
                            {!! Form::text('email',null,['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('password','Contraseña',['class' => 'control-label']) !!}
                            {!! Form::password('password', ['class' => 'form-control', 'required']) !!}
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