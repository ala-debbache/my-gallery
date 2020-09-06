@extends('layouts.blog')
@section('title')
    {{$user->name}}
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
            <div class="span3 well">
                @if (session('success'))
                    <p class="alert">{{session('success')}}</p>
                @endif
                @if($user->avatar=='')
                    <a href="{{asset('img/avatar.webp')}}" class="link-image js-zoom-image">
                        <img src="{{asset('img/avatar.webp')}}" id="avatar" width="30%" height="30%" class="rounded-circle">
                    </a>
                @else
                    <a href="{{asset($user->avatar)}}" class="link-image js-zoom-image">
                        <img src="{{asset($user->avatar)}}" id="avatar" width="30%" height="30%" class="rounded-circle">
                    </a>
                @endif
                <h1 class="stunning-header-title mt-2">{{$user->name}}</h1><br>
                @if($user->facebook)
                    <a class="share-btn f" href="{{$user->facebook}}" target="_blank"><i class="fa fa-facebook"></i></a>
                @endif
                @if($user->instagram)
                    <a class="share-btn i" href="{{$user->instagram}}" target="_blank"><i class="fa fa-instagram"></i></a>
                @endif
                @if($user->twitter)
                    <a class="share-btn t" href="{{$user->twitter}}" target="_blank"><i class="fa fa-twitter"></i></a>
                @endif
            </div>
            @auth
                @if($user->id===auth()->user()->id)
                <a href="{{route('edit-profile',$user->id)}}" class="btn btn-success mt-5">EDIT PROFILE</a>
                @endif
            @endauth

        </div>
    </div>

    <!-- End Stunning Header -->

    <!-- Post Details -->

    <div class="header-spacer"></div>
    <div class="container">

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

    </div>

</div>
@endsection
@section('scripts')

@endsection
