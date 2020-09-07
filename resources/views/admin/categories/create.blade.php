@extends('layouts.dash')

@section('content')
<div class="container">
    <h3><i class="fa fa-angle-right"></i>{{isset($category)? 'Add categories':'Edit categories'}}</h3>
    <div class="row mt">
        <div class="col-lg-12">
          <div class="form-panel">
            <h4 class="mb"><i class="fa fa-angle-right"></i>{{isset($category)? 'Update category':'Create '}}</h4>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p class="alert danger">{{$error}}</p>
                @endforeach
            @endif
            <form class="form-horizontal style-form"action="{{isset($category)? route('categories.update',$category->id):route('categories.store')}}" method="POST">
                @csrf
                @if(isset($category))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label" style="margin-left:10px; font-size:18px;">Name</label>
                    <div class="col-sm-8">
                    <input type="text" name="name" class="form-control" value="{{isset($category)?$category->name:''}}">
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success">{{isset($category)?'Update Category':'Create Category'}}</button>
                </div>
            </form>
          </div>
        </div>
        <!-- col-lg-12-->
    </div>

</div>
@endsection
