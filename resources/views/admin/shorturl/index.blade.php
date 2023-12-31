@extends('layouts.backend_layout.template')
@push('styles')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
<style>
    .table-bordered, th, td {
        border: 1px solid green !important;
    }
</style>
@section('backend-css')
    <style>
        .badge{
            border-radius: 3px solid black;
            background-color: green;
        }
    </style>
@endsection
@section('main-content')
<form action="{{ route('shorten') }}" method="post">
    @csrf
    <label for="url">Enter URL:</label>
    <input type="text" name="url" required>
    <button type="submit">Shorten</button>
</form>

@endsection
