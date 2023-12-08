@extends('layouts.master')

@section('title', 'License Status')

@section('page_styles')

@endsection

@section('page_scripts')
@endsection

@section('content')
 <h2 style="text-align: center;">License is {{$status}}</h2>
@endsection