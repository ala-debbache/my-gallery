@extends('layouts.blog')
@section('title')
MY GALLERY
@endsection
@section('styles')
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom2.css')}}">
@endsection
@section('content')
<button id="go_top"><i class="fa fa-arrow-up"></i></button>
    <div class="header-spacer"></div>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="heading">
                    <h4 class="h1 heading-title">Latest posts</h4>
                    <div class="heading-line">
                        <span class="short-line"></span>
                        <span class="long-line"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="padded-50"></div>

        <div class="row">

            <div class="col-lg-6">
                @for ($i=0;$i<12;$i++)
                @if(!$posts[$i])
                    <?php $i=12; ?>
                @else
                    @if ($i%2==0)
                            <article class="hentry post post-standard has-post-thumbnail sticky">

                                <div class="post-thumb">
                                    <img src="{{asset($posts[$i]->image)}}" class="post_img" width="500px" height="300px" alt="seo">
                                    <div class="overlay"></div>
                                    <a href="{{asset($posts[$i]->image)}}" class="link-image js-zoom-image">
                                        <i class="seoicon-zoom"></i>
                                    </a>
                                    <a href="{{route('single-post',$posts[$i]->id)}}" class="link-post">
                                        <i class="seoicon-link-bold"></i>
                                    </a>
                                </div>

                                <div class="post__content">

                                    <div class="post__content-info">

                                            <h2 class="post__title entry-title ">
                                                <a href="{{route('single-post',$posts[$i]->id)}}">{{$posts[$i]->title}}</a>
                                            </h2>

                                            <div class="post-additional-info">

                                                <span class="post__date">

                                                    <i class="seoicon-clock"></i>

                                                    <time class="published" datetime="2016-04-17 12:00:00">
                                                        {{$posts[$i]->created_at->diffForHumans()}}
                                                    </time>

                                                </span>

                                                <span class="post__comments">
                                                    <a href="#"><i class="fa fa-comment-o" aria-hidden="true"></i></a>
                                                    12
                                                </span>

                                            </div>
                                    </div>
                                </div>

                            </article>
                    @endif
                @endif
            @endfor
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xl-6">
                @for ($i=0;$i<12;$i++)
                @if(!$posts[$i])
                    <?php $i=12; ?>
                @else
                    @if ($i%2!=0)
                        <article class="hentry post post-standard has-post-thumbnail sticky">

                            <div class="post-thumb">
                                <img src="{{asset($posts[$i]->image)}}" class="post_img" width="500px" height="300px" alt="seo">
                                <div class="overlay"></div>
                                <a href="{{asset($posts[$i]->image)}}" class="link-image js-zoom-image">
                                    <i class="seoicon-zoom"></i>
                                </a>
                                <a href="{{route('single-post',$posts[$i]->id)}}" class="link-post">
                                    <i class="seoicon-link-bold"></i>
                                </a>
                            </div>

                            <div class="post__content">

                                <div class="post__content-info">

                                        <h2 class="post__title entry-title ">
                                            <a href="{{route('single-post',$posts[$i]->id)}}">{{$posts[$i]->title}}</a>
                                        </h2>

                                        <div class="post-additional-info">

                                            <span class="post__date">

                                                <i class="seoicon-clock"></i>

                                                <time class="published" datetime="2016-04-17 12:00:00">
                                                    {{$posts[$i]->created_at->diffForHumans()}}
                                                </time>

                                            </span>

                                            <span class="post__comments">
                                                <a href="#"><i class="fa fa-comment-o" aria-hidden="true"></i></a>
                                                6
                                            </span>

                                        </div>
                                </div>
                            </div>

                        </article>
                    @endif
                @endif
                @endfor

            </div>


        </div>
        <div class="padded-50"></div>
    </div>



    <div class="container-fluid" id="categories_section">
        <div class="row medium-padding120 bg-border-color">
            <div class="container">
                <div class="col-lg-12">
                <div class="offers">
                    <div class="row">
                        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                            <div class="heading">
                                <h4 class="h1 heading-title">Categories</h4>
                                <div class="heading-line">
                                    <span class="short-line"></span>
                                    <span class="long-line"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="case-item-wrap">
                            @foreach($categories as $category)
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="case-item">
                                    <h6 class="case-item__title text-center"><a href="{{route('category',$category->id)}}">{{$category->name}}</a></h6>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="padded-50"></div>
            </div>
            </div>
        </div>
    </div>
    </div>
@endsection






        {{-- <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif --}}
