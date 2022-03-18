@extends('layouts.main')

@section('title', 'Ideas')

@section('custom-css')
<style>
    .entry-content .gallery {
        margin: 0;
        list-style: none;
        padding: 0;
    }

    .activity__list__header a {
        color: #222;
        font-weight: 600;
    }

    .activity__list__footer {
        display: -ms-flexbox;
        display: -webkit-box;
        display: flex;
        padding: 13px 8px 0;
        color: #999;
        border-top: 1px dotted #ccc;
    }

    .activity__list__footer a {
        color: inherit;
    }

    .activity__list__footer a+a {
        margin-left: 15px;
    }

    .activity__list__footer i {
        margin-right: 8px;
    }

    .activity__list__footer a:hover {
        color: #222;
    }

    .activity__list__footer span {
        margin-left: auto;
    }

    .panel-activity__list>li+li {
        margin-top: 51px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div>
                <h4 class="title d-inline">LASTEST IDEA</h4>
                @include('ideas.create')
                <button class="btn btn-success d-inline float-md-end">My Idea</button>
            </div>
            <div class="my-lg-3">
                @foreach ($ideas as $idea)
                <div class="card mt-3">
                    <div class="card-body">
                        <h5>{{ $idea->title }}</h5>
                        <small class="text-muted">
                            Post by: {{ $idea->user->name }}
                        </small>
                        <div class="">
                            <p>
                                {{ $idea->content }}
                            </p>
                        </div>
                        <div class="activity__list__footer">
                            <a href="#"> <i class="fa fa-thumbs-up"></i>123</a>
                            <a href="#"> <i class="fa fa-thumbs-down"></i>123</a>
                            <a href="#"> <i class="fa fa-comments"></i>{{ $idea->comments_count }}</a>
                            <span> <i class="fa fa-clock"></i>{{ $idea->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    <form action="{{url('/ideas/'.$idea->id)}}" method="GET">
                        <div class=" timeline-comment-box float-right">
                            <button type="submit" class="btn btn-primary" onclick="window.location.href='{{url('/ideas/'.$idea->id)}}'">See more</button>
                        </div>
                    </form>
                </div>
                @endforeach
                {{ $ideas->links() }}
            </div>
        </div>
        <div class="col-md-3">
            @include('ideas.search')
        </div>
    </div>
</div>
<!-- jQuery library -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>

<!-- Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>

<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
@endsection