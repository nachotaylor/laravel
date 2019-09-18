@extends('adminlte::page')

@section('title', 'Laravel')

@push('css')

@push('js')

@section('js')
    <script>
        $(document).ready(function () {
            $('#table').DataTable({
                language: {
                    'url': '//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
                }
            });
        });
    </script>
@stop