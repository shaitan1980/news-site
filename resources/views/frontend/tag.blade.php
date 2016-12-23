@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Тег: </strong> {{ $tag->title }}</div>
                    <div class="panel-body">
                        <h3 class="page-header">{{ $tag->title }}</h3>
                        @foreach($tag->news as $newsTag)
                            <p><a href="{{ route('getNewsPost', ['slug' => $newsTag->slug]) }}">{{ $newsTag->title }}</a></p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection