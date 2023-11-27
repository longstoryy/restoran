<!-- resources/views/emails/sample.blade.php -->
@extends('layouts.app')

@section('content')


    <div>
        <h1><b>Customer Email</b></h1>

        <h1>Hello, {{ $data['name'] }}</h1>
        <p>Email: {{ $data['email'] }}</p>
        <p>Subject: {{ $data['subject'] }}</p>
        <p>{{ $data['message'] }}</p>
    </div>
 
@endsection


