@extends('layouts.blog')
@section('title')
    Search for {{$query}}
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
            <h1 class="stunning-header-title">Search for {{$query}}</h1>
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
