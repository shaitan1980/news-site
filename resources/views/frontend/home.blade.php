@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Реклама</strong></div>
                    <div class="panel-body">
                        @foreach($commercial as $commercePost)
                            @if($commercePost->position === 'left')
                                <div class="commerce">
                                    <p><strong>{{ $commercePost->good }}</strong></p>
                                    <p>{{ $commercePost->seller }}</p>
                                    <p>{{ $commercePost->website }}</p>
                                    <p><strong>Price: </strong>{{ number_format($commercePost->price, 2, ',', ' ') }} грн.</p>
                                    <div class="hidden-commerce">
                                        <p><strong>Скидка 10%</strong></p>
                                        <p><strong>New price: </strong>{{ number_format($commercePost->price/1.1, 2, ',', ' ') }} грн.</p>
                                        <p><strong>Купон скидки: </strong> {{ $commercePost->kupon }}</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-6">

                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="3"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        @php $i=1 @endphp
                        @foreach($news as $newsItem)
                            <div class="item {{ $i==1 ? 'active' : '' }}">
                                <img src="{{ $newsItem->image }}" alt="{{ $newsItem->title }}">
                                <div class="carousel-caption">
                                    {{ $newsItem->title }}
                                </div>
                            </div>
                            @php $i++ @endphp
                        @endforeach
                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Новостной сайт</strong> <a href="{{ route('getAnalitics') }}" class="pull-right">Аналитические новости</a></div>
                    <div class="panel-body">
                        <h3>Активные комментаторы</h3>
                        @foreach($countComments as $key => $value)
                            <p>Автор: <strong>{{ $key }}</strong> количество комментариев: {{ $value }}</p>
                        @endforeach
                        <hr>
                        @foreach($categories as $category)
                            <h3>
                                <a href="{{ route('getCategory', ['category' => $category->slug]) }}">{{ $category->title }}</a>
                            </h3>

                            @php
                                $chunk = $category->newsCat->take(5)
                            @endphp

                            @foreach($chunk as $newsCat)
                                <p>
                                    <a href="{{ route('getNewsPost', ['slug' => $newsCat->slug]) }}">{{ $newsCat->title }}</a>
                                    @if($newsCat->is_analitics === 1)
                                        <span class="text-warning">Это аналитическая статья</span>
                                    @endif
                                </p>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Реклама</strong></div>
                    <div class="panel-body">
                        @foreach($commercial as $commercePost)
                            @if($commercePost->position === 'right')
                                <div class="commerce">
                                    <p><strong>{{ $commercePost->good }}</strong></p>
                                    <p>{{ $commercePost->seller }}</p>
                                    <p>{{ $commercePost->website }}</p>
                                    <p><strong>Price: </strong>{{ number_format($commercePost->price, 2, ',', ' ') }} грн.</p>
                                    <div class="hidden-commerce">
                                        <p><strong>Скидка 10%</strong></p>
                                        <p><strong>New price: </strong>{{ number_format($commercePost->price/1.1, 2, ',', ' ') }} грн.</p>
                                        <p><strong>Купон скидки: </strong> {{ $commercePost->kupon }}</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection