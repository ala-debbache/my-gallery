@extends('layouts.dash')
@section('styles')
  <link rel="stylesheet" href="{{asset('dash/css/to-do.css')}}">
@endsection
@section('content')
<div class="row mt">
    <div class="col-md-12">
        @if (session('success'))
            <p class="alert success">{{session('success')}}</p>
        @endif
        <section class="task-panel tasks-widget">
            <div class="panel-heading">
            <div class="pull-left">
                @if (isset($trashed))
                    <h4>All trashed Posts</h4>
                @elseif(isset($confirmed))
                    <h4>All unconfirmed Posts</h4>
                @else
                    <h4>All Posts</h4>
                @endif
            </div>
            <br>
            </div>
            <div class="panel-body">
                <div class="task-content">
                    <ul class="task-list">
                        @if($posts->count()===0)
                            <h2>No Posts yet</h2>
                        @else
                            @foreach ($posts as $post)
                                <li>
                                    <div class="task-title">
                                    <span class="task-title-sp">{{$post->title}}</span>
                                    <span class="badge bg-theme">{{$post->user->name}}</span>
                                    <div class="pull-right" style="display:flex;">
                                        @if($post->trashed())
                                            <form action="{{route('trashed.restore',$post->id)}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success btn-xs"><i class="fa fa-undo"></i></button>
                                            </form>
                                        @else
                                            @if($post->user_id===auth()->user()->id)
                                            <a href="{{route('posts.edit',$post->id)}}" class="btn btn-primary btn-xs" style="margin-left:5px;"><i class="fa fa-pencil"></i></a>
                                            @endif
                                            @if ($post->confirmed===0)
                                                <a href="{{route('single-post',$post->id)}}" class="btn btn-warning btn-xs" style="margin-left:5px;" target="_blank"><i class="fa fa-eye"></i></a>
                                                <form action="{{route('confirmed.confirm',$post->id)}}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-success btn-xs" style="margin-left:5px;"><i class="fa fa-check"></i></button>
                                                </form>
                                            @endif
                                        @endif
                                        <form action="{{route('posts.destroy',$post->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-xs" style="margin-left:5px;"><i class="fa fa-trash-o "></i></button>
                                        </form>
                                    </div>
                                    </div>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
