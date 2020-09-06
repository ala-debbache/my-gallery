@extends('layouts.dash')

@section('styles')
<script src="https://use.fontawesome.com/3ffa49f7d8.js"></script>
@endsection
@section('content')
<div class="container">
    <div class="row mt">
        <div class="col-md-4 col-sm-4 mb">
            <div class="darkblue-panel pn">
                <div class="darkblue-header">
                    <h5>Users</h5>
                </div>
                <h1 class="mt"><i class="fa fa-users fa-3x"></i></h1>
                <footer>
                    <div class="centered">
                    <h3>{{$users}}</h3>
                    </div>
                </footer>
            </div>
            <!--  /darkblue panel -->
        </div>
        <div class="col-md-4 col-sm-4 mb">
            <div class="darkblue-panel pn">
                <div class="darkblue-header">
                    <h5>Tags</h5>
                </div>
                <h1 class="mt"><i class="fa fa-tags fa-3x"></i></h1>
                <footer>
                    <div class="centered">
                    <h3>{{$tags}}</h3>
                    </div>
                </footer>
            </div>
            <!--  /darkblue panel -->
        </div>
        <div class="col-md-4 col-sm-4 mb">
            <div class="darkblue-panel pn">
                <div class="darkblue-header">
                    <h5>Categories</h5>
                </div>
                <h1 class="mt"><i class="fa fa-list-ul fa-3x"></i></h1>
                <footer>
                    <div class="centered">
                    <h3>{{$categories}}</h3>
                    </div>
                </footer>
            </div>
            <!--  /darkblue panel -->
        </div>
        <div class="col-md-4 col-sm-4 mb">
            <div class="darkblue-panel pn">
                <div class="darkblue-header">
                    <h5>Shared Posts</h5>
                </div>
                <h1 class="mt"><i class="fa fa-image fa-3x"></i></h1>
                <footer>
                    <div class="centered">
                    <h3>{{$shared}}</h3>
                    </div>
                </footer>
            </div>
            <!--  /darkblue panel -->
        </div>
        <div class="col-md-4 col-sm-4 mb">
            <div class="darkblue-panel pn">
                <div class="darkblue-header">
                    <h5>Trashed Posts</h5>
                </div>
                <h1 class="mt"><i class="fa fa-trash fa-3x"></i></h1>
                <footer>
                    <div class="centered">
                    <h3>{{$trashed}}</h3>
                    </div>
                </footer>
            </div>
            <!--  /darkblue panel -->
        </div>
        <div class="col-md-4 col-sm-4 mb">
            <div class="darkblue-panel pn">
                <div class="darkblue-header">
                    <h5>Unconfirmed</h5>
                </div>
                <h1 class="mt"><i class="fa fa-hourglass fa-3x"></i></h1>
                <footer>
                    <div class="centered">
                    <h3>{{$unconfirmed}}</h3>
                    </div>
                </footer>
            </div>
            <!--  /darkblue panel -->
        </div>
    </div>
</div>
@endsection
@section('scripts')

@endsection
