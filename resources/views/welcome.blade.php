@extends('layouts.app')

@section('content')

    <front-page></front-page>
    <flash-message text="{{session('flash')}}"></flash-message>

@endsection
