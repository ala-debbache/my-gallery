@extends('layouts.dash')

@section('content')
<div class="container">
    <h3><i class="fa fa-angle-right"></i>  {{isset($tag)?'Edit Tags':'Add Tags'}}</h3>
    <div class="row mt">
        <div class="col-lg-12">
          <div class="form-panel">
            <h4 class="mb"><i class="fa fa-angle-right"></i>  {{isset($tag)?'Update tag':'Create tag'}}</h4>
            <form class="form-horizontal style-form"action="{{isset($tag)? route('tags.update',$tag->id):route('tags.store')}}" method="POST">
                @csrf
                @if(isset($tag))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label" style="margin-left:10px; font-size:18px;">Name</label>
                    <div class="col-sm-8">
                    <input type="text" name="name" class="form-control" value="{{isset($tag)?$tag->name:''}}">
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success">{{isset($tag)?'Update tag':'Create tag'}}</button>
                </div>
            </form>
          </div>
        </div>
        <!-- col-lg-12-->
    </div>
    
</div>
@endsection