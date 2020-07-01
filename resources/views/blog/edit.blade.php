@extends('layouts.blog')
@section('title')
    Edit profile 
@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <!-- Styles -->
    <link href="{{ asset('css/custom2.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="content-wrapper">
    <button id="go_top"><i class="fa fa-arrow-up"></i></button>
    
    <!-- Stunning Header -->
    
    <div class="stunning-header stunning-header-bg-lightviolet">
        <div class="stunning-header-content">
            <h1 class="stunning-header-title">EDIT PROFILE</h1>
        </div>
    </div>
    
    <!-- End Stunning Header -->
    
    <!--  Details -->
    
    
    <div class="container">
        <div class="row medium-padding120">
            <main class="main">
                
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-12">
                            <form action="{{route('update-profile',$user->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="avatar"><h4>Avatar</h4></label><br> 
                                    <img src="/img/placeholder.jpg" id="avatar-dis" width="200px" height="200px"><br><br>
                                    <button type="button" id="btn-avatar" class="btn btn-success">Upload Image</button>
                                    <input type="file" id="avatar" hidden="true" name="avatar" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="name"><h4>Name</h4></label>
                                    <input type="text" id="name" name="name" class="form-control" value="{{$user->name}}" >
                                </div>
                                <div class="form-group">
                                    <label for="facebook"><h4>Facebook</h4></label>
                                    <input type="text" id="facebook" name="facebook" class="form-control" value="{{$user->facebook}}" >
                                </div>
                                <div class="form-group">
                                    <label for="instagram"><h4>Instagram</h4></label>
                                    <input type="text" id="instagram" name="instagram" class="form-control" value="{{$user->instagram}}" >
                                </div>
                                <div class="form-group">
                                    <label for="twitter"><h4>Twitter</h4></label>
                                    <input type="text" id="twitter" name="twitter" class="form-control" value="{{$user->twitter}}" >
                                </div>
                                <div class="form-group">
                                    <label for="about"><h4>About</h4></label>
                                    <textarea type="text" id="about" name="about" class="form-control">{{$user->about}}</textarea>
                                </div>
                                <button type="submit" class="btn btn-success">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- End  Details -->
                <br>
                <br>
                <br>
                <!-- Sidebar-->
    
                <div class="col-lg-12" id="categories_section">
                    <aside aria-label="sidebar" class="sidebar sidebar-right">
                        <div  class="widget w-tags">
                            <div class="heading text-center">
                                <h4 class="h1 heading-title">ALL CATEGORIES</h4>
                                <div class="heading-line">
                                    <span class="short-line"></span>
                                    <span class="long-line"></span>
                                </div>
                            </div>
    
                            <div class="tags-wrap">
                                @foreach ($categories as $category)
                                    <a href="{{route('category',$category->id)}}" class="w-tags-item">{{$category->name}}</a>
                                @endforeach
                            </div>
                        </div>
                    </aside>
                </div>
    
                <!-- End Sidebar-->
    
            </main>
        </div>
    </div>
    
</div>
@endsection
@section('scripts')
<script>
    const btn=document.getElementById('btn-avatar');
    const inp=document.getElementById('avatar');
    const display=document.getElementById('avatar-dis');
    btn.addEventListener('click',function(){
        inp.click();
    });
    inp.addEventListener('change',function(){
        const file=this.files[0];
        if(file){
            const reader=new FileReader();
            reader.addEventListener('load',function(){
                display.setAttribute("src",this.result);
            });
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection