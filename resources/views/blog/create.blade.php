@extends('layouts.blog')
@section('title')
{{isset($post)?'Edit post':'Create post'}}
@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Styles -->
    <link href="{{ asset('css/custom2.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/inputs.css') }}" rel="stylesheet"> --}}
    <style>
        a{
            text-decoration-line: none;
        }
    </style>
@endsection
@section('content')
<div class="content-wrapper">
    <button id="go_top"><i class="fa fa-arrow-up"></i></button>

    <!-- Stunning Header -->

    <div class="stunning-header stunning-header-bg-lightviolet">
        <div class="stunning-header-content">
            <h1 class="stunning-header-title">{{isset($post)?'EDIT POST':'CREATE POST'}}</h1>
        </div>
    </div>

    <!-- End Stunning Header -->

    <!-- Post Details -->


    <div class="container">
        <div class="row medium-padding120">
            <main class="main">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <p class=" danger">{{$error}}</p>
                    @endforeach
                @endif
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-12">
                            <form action="{{isset($post)?route('update-post',$post->id):route('store-post')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @if(isset($post))
                                    @method('PUT')
                                @endif
                                <div class="form-group">
                                    <label for="title"><h4>Title</h4></label>
                                    <input type="text" id="title" name="title" class="form-control" value="{{isset($post)?$post->title:''}}" >
                                </div>
                                <div class="form-group">
                                    <label for="image"><h4>Image</h4></label><br>
                                    <img src="{{isset($post)?asset($post->image):'/img/placeholder.jpg'}}" id="image-dis" width="200px" height="200px"><br><br>
                                    <button type="button" id="btn-image" class="btn btn-success">Upload Image</button>
                                    <input type="file" id="image" hidden="true" name="image" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="content"><h4>Content</h4></label>
                                    <input id="content" name="content" type="hidden" value="{{isset($post)?$post->content:''}}">
                                    <trix-editor input="content"></trix-editor>
                                </div>
                                <div class="form-group">
                                    <label for="category"><h4>Category</h4></label>
                                    <select id="category" name="category_id" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}"
                                                @if(isset($post) && $category->id == $post->category_id)
                                                    selected
                                                @endif>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tags"><h4>Tags</h4></label>
                                    <select id="tags" name="tags[]" class="form-control js-example-basic-multiple" multiple>
                                        @foreach ($tags as $tag)
                                            <option value="{{$tag->id}}"
                                                @if(isset($post))
                                                @if(in_array($tag->id,$post->tags->pluck('id')->toArray()))
                                                    selected
                                                @endif
                                                @endif >{{$tag->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">{{isset($post)?'EDIT':'CREATE'}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- End Post Details -->
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
    const btn=document.getElementById('btn-image');
    const inp=document.getElementById('image');
    const display=document.getElementById('image-dis');
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
