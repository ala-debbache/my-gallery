@extends('layouts.dash')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
@endsection

@section('content')
<div class="container">
    <h3><i class="fa fa-angle-right"></i>  Add Posts</h3>
    <div class="row mt">
        <div class="col-lg-12">
          <div class="form-panel">
            <h4 class="mb"><i class="fa fa-angle-right"></i> Create Post</h4>
            <form class="form-horizontal style-form" action="{{isset($post)? route('posts.update',$post->id):route('posts.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($post))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label" style="margin-left:10px; font-size:18px;">Title</label>
                    <div class="col-sm-8">
                    <input type="text" name="title" class="form-control" value="{{isset($post)?$post->title:''}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label" style="margin-left:10px; font-size:18px;">Image</label>
                    <div class="col-sm-8">
                    <input type="file" name="image" class="form-control" value="{{isset($post)?$post->image:''}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label" style="margin-left:10px; font-size:18px;">Content</label>
                    <div class="col-sm-8">
                    <input id="content" name="content" type="hidden" value="{{isset($post)?$post->content:''}}">
                    <trix-editor input="content"></trix-editor>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label" style="margin-left:10px; font-size:18px;">Category</label>
                    <div class="col-sm-8">
                    <select id="category" name="category_id" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}" 
                                @if(isset($post) && $category->id == $post->category_id)
                                    selected
                                @endif>{{$category->name}}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label" style="margin-left:10px; font-size:18px;">TAgs</label>
                    <div class="col-sm-8">
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
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success">{{isset($post)?'Update Post':'Create Post'}}</button>
                </div>
            </form>
          </div>
        </div>
        <!-- col-lg-12-->
    </div>
    
</div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endsection