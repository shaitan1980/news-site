@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Категория: </strong> {{ $category->title }}</div>
                    <div class="panel-body">
                        <h3 class="page-header">{{ $category->title }}</h3>
                        @foreach($category->newsCat()->paginate(5) as $newsCat)
                            <p><a href="{{ route('getNewsPost', ['slug' => $newsCat->slug]) }}">{{ $newsCat->title }}</a></p>
                        @endforeach
                        <div>
                            {{ $category->newsCat()->paginate(5)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection