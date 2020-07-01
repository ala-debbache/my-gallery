@extends('layouts.dash')
@section('styles')
    
  <link rel="stylesheet" href="{{asset('dash/css/to-do.css')}}">
@endsection
@section('content')
<div class="row mt">
    <div class="col-md-12">
        <section class="task-panel tasks-widget">
            <div class="panel-heading">
            <div class="pull-left">
                <h4>All Users</h4>
            </div>
            <br>
            </div>
            <div class="panel-body">
                <div class="task-content">
                    <ul class="task-list">
                        @foreach ($users as $user)
                            <li>
                                <div class="task-title">
                                <span class="task-title-sp" style="margin-right:100px">{{$user->name}}</span>
                                <span class="task-title-sp">{{$user->email}}</span>
                                
                                <div class="pull-right hidden-phone" style="display:flex;">
                                    @if($user->isadmin())
                                        <span class="badge bg-theme">Admin</span>
                                    @endif
                                    {{-- @if (!$user->isadmin())
                                        <form action="{{route('make-admin',$user->id)}}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                                        </form>
                                    @endif    --}}
                                </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>
    </div>  
</div>
@endsection