@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Категория: </strong> Аналитические новости</div>
                    <div class="panel-body">
                        <h3 class="page-header">Аналитические новости</h3>
                        @foreach($analitics as $news)
                            <p><a href="{{ route('getNewsPost', ['slug' => $news->slug]) }}">{{ $news->title }}</a></p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection