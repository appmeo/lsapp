@extends('Layouts.master')

@section('content')
<div class="jumbotron text-center">
    <h1>{{$title}}</h1>
    <p>This is the first Laravel Application for Immo Site Coga</p>
    <P>
            <a class="btn btn-primary btn-lg" href="http://lsapp.test/login" role="button">Login</a>
            <a class="btn btn-success btn-lg" href="http://lsapp.test/register" role="button">Register</a>
    </P>
</div>
@endsection

   