@extends('Layouts.master')

@section('content')
    <a href="/posts" class="btn btn-outline-primary">Go Back</a>
    <br>
    <br>
    <h1>{{$post->title}}</h1>
    
    <img style="width:50%;border:1px solid" class="mb-3" src="/storage/cover_images/{{$post->cover_image}}">
    <hr>
    <p>{{$post->body}}</p>
    <hr>
    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
    <hr>
    @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id)
            <a href="/posts/{{$post->id}}/edit" class="btn btn-outline-success">Edit Post</a>
            
            {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                        {{Form::hidden('_method', 'DELETE')}}
                        {{Form::submit('Delete', ['class' => 'btn btn-outline-danger'])}}
            {!!Form::close()!!}
        @endif
    @endif
@endsection