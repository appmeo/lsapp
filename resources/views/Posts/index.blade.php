@extends('Layouts.master')

@section('content')
    <h1>Posts</h1>
        @if(count($Posts) > 0)
            @foreach($Posts as $post)
                <div class="well border border-primary rounded">
                    <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <img  style="padding:6px;width:100%" src="/storage/cover_images/{{$post->cover_image}}">
                    </div>
                    <div class="col-md-8 col-sm-8">
                            <h3 class="ml-2 mt-2"><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                            <p class="ml-2 mt-1">{{$post->body}}</p>
                            <small class="ml-2 mt-1">Written on {{$post->created_at}} by {{$post->user->name}}</small>
                    </div>  
                </div>
                </div>
                <br>
            @endforeach
            {{$Posts->links()}}
        @else    
                <p>No Posts found</p>
        @endif
@endsection