@extends('layouts.blog')
@section('title')
    {{$post->title}}
@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom2.css')}}">
@endsection
@section('content')
<div class="content-wrapper">
    <button id="go_top"><i class="fa fa-arrow-up"></i></button>
    <!-- Stunning Header -->
    
    <div class="stunning-header stunning-header-bg-lightviolet">
        <div class="stunning-header-content">
            <h1 class="stunning-header-title">{{$post->title}}</h1>
        </div>
    </div>
    
    <!-- End Stunning Header -->
    
    <!-- Post Details -->
    
    
    <div class="container">
        <div class="row medium-padding120">
            <main class="main">
                <div class="col-lg-10 col-lg-offset-1">
                    <article class="hentry post post-standard-details">
    
                        <div class="post-thumb">
                            <img src="/storage/{{$post->image}}" alt="seo">
                        </div>
    
                        <div class="post__content">
    
    
                            <div class="post-additional-info">
    
                                <div class="post__author author vcard">
                                    Posted by
    
                                    <div class="post__author-name fn">
                                        <a href="{{route('profile',$post->user->id)}}" class="post__author-link">{{$post->user->name}}</a>
                                    </div>
    
                                </div>
    
                                <span class="post__date">
    
                                    <i class="seoicon-clock"></i>
    
                                    <time class="published" datetime="2016-03-20 12:00:00">
                                        {{$post->created_at->diffForHumans()}}
                                    </time>
    
                                </span>
    
                                <span class="category">
                                    <i class="seoicon-tags"></i>
                                    <a href="{{route('category',$post->category->id)}}">{{$post->category->name}}</a>
                                </span>
    
                            </div>
    
                            <div class="post__content-info">
                                @auth
                                    @if ($post->user_id===auth()->user()->id)
                                        <div style="display:flex;">
                                            <a class="btn btn-success mr-3" href="{{route('edit-post',$post->id)}}">Edit</a>
                                            <form action="">
                                                <button class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                                <p class="post__subtitle">{!!$post->content!!}</p>
    
                                <div class="widget w-tags">
                                    <h6 class="h4 heading-title">Relative Tags</h6>
                                    <div class="tags-wrap">
                                        @foreach ($post->tags as $tag)
                                            <a href="{{route('tag',$tag->id)}}" class="w-tags-item">{{$tag->name}}</a>
                                        @endforeach
                                    </div>
                                </div>
                                
                            </div>
                        </div>
    
                        <div class="socials">Share:
                            <a href="#" class="social__item">
                                <i class="seoicon-social-facebook"></i>
                            </a>
                            <a href="#" class="social__item">
                                <i class="seoicon-social-twitter"></i>
                            </a>
                            <a href="#" class="social__item">
                                <i class="seoicon-social-linkedin"></i>
                            </a>
                            <a href="#" class="social__item">
                                <i class="seoicon-social-google-plus"></i>
                            </a>
                            <a href="#" class="social__item">
                                <i class="seoicon-social-pinterest"></i>
                            </a>
                        </div>
    
                    </article>
    
                    <div class="blog-details-author">
    
                        <div class="blog-details-author-thumb">
                            @if($post->user->avatar=='')
                            <img src="/storage/avatar/avatar.webp" id="posted_by" alt="Author">
                            @else
                            <img src="/storage/{{$post->user->avatar}}" id="posted_by" alt="Author">
                            @endif
                        </div>
    
                        <div class="blog-details-author-content">
                            <div class="author-info">
                                <a href="{{route('profile',$post->user->id)}}"><h5 class="author-name">{{$post->user->name}}</h5></a>
                            </div>
                            <p class="text">
                                {{$post->user->about}}
                            </p>
                            <div class="socials">
                                @if($post->user->facebook)
                                    <a href="{{$post->user->facebook}}" class="social__item" target="_blank">
                                        <img src="{{asset('svg/circle-facebook.svg')}}" alt="facebook">
                                    </a>
                                @endif

                                @if($post->user->instagram)
                                    <a href="{{$post->user->instagram}}" class="social__item" target="_blank">
                                        <img src="{{asset('svg/Instagram.svg.png')}}" alt="twitter">
                                    </a>
                                @endif
                                
                                @if($post->user->twitter)
                                    <a href="{{$post->user->twitter}}" class="social__item" target="_blank">
                                        <img src="{{asset('svg/twitter.png')}}" alt="instagram">
                                    </a>
                                @endif
    
                            </div>
                        </div>
                    </div>
    
                    <div class="comments">
    
                        <div class="heading text-center">
                            <h4 class="h1 heading-title">Comments</h4>
                            <div class="heading-line">
                                <span class="short-line"></span>
                                <span class="long-line"></span>
                            </div>
                        </div>
                    </div>
    
                    <div class="row">
    
                    </div>
    
    
                </div>
    
                <!-- End Post Details -->
    
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