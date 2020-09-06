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
        @if (session('danger'))
            <p class="alert danger">{{session('danger')}}</p>
        @endif
        <section class="task-panel tasks-widget">
            <div class="panel-heading">
            <div class="pull-left">
                <h4>All Categories</h4>
            </div>
            <br>
            </div>
            <div class="panel-body">
                <div class="task-content">
                    <ul class="task-list">
                        @if($categories->count()===0)
                            <h2>No categories yet</h2>
                        @else
                            @foreach ($categories as $category)
                                <li>
                                    <div class="task-title">
                                    <span class="task-title-sp">{{$category->name}}</span>
                                    <span class="badge bg-theme">{{$category->posts()->count()}}</span>
                                    <div class="pull-right" style="display:flex;">
                                        <a href="{{route('categories.edit',$category->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                        <form action="{{route('categories.destroy',$category->id)}}" method="POST">
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
        <!-- /col-md-12-->
</div>
@endsection
