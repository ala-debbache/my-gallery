@extends('layouts.dash')

@section('content')
<div class="container">
    <h3><i class="fa fa-angle-right"></i>  Add user</h3>
    <div class="row mt">
        <div class="col-lg-12">
          <div class="form-panel">
            <h4 class="mb"><i class="fa fa-angle-right"></i> Create user</h4>
            <form class="form-horizontal style-form" action="{{route('user.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($user))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label" style="margin-left:10px; font-size:18px;">Name</label>
                    <div class="col-sm-8">
                    <input type="text" name="name" class="form-control" value="{{isset($user)?$user->name:''}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label" style="margin-left:10px; font-size:18px;">Facebook</label>
                    <div class="col-sm-8">
                    <input type="text" name="facebook" class="form-control" value="{{isset($user)?$user->facebook:''}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label" style="margin-left:10px; font-size:18px;">Instagram</label>
                    <div class="col-sm-8">
                    <input type="text" name="instagram" class="form-control" value="{{isset($user)?$user->instagram:''}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label" style="margin-left:10px; font-size:18px;">Twitter</label>
                    <div class="col-sm-8">
                    <input type="text" name="twitter" class="form-control" value="{{isset($user)?$user->twitter:''}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label" style="margin-left:10px; font-size:18px;">Avatar</label>
                    <div class="col-sm-8">
                    <input type="file" name="avatar" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label" style="margin-left:10px; font-size:18px;">About</label>
                    <div class="col-sm-8">
                    <textarea rows="7" type="text" name="about" class="form-control">{{isset($user)?$user->about:''}}</textarea>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success">Update profile</button>
                </div>
            </form>
          </div>
        </div>
        <!-- col-lg-12-->
    </div>
    
</div>
@endsection