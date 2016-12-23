@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Новость: </strong> {{ $newsPost->title }}</div>
                    <div class="panel-body">
                        <h3 class="page-header">{{ $newsPost->title }}</h3>
                        <div class="img-wrapper">
                            <img src="{!! $newsPost->image !!}" alt="image {{ $newsPost->title }}">
                        </div>
                        <div>
                            {!! $newsPost->body !!}
                        </div>
                        <hr>
                        <p><strong>Автор: </strong>{{ $newsPost->author->name }}</p>
                        <hr>
                        <p>
                            <strong>Категория: </strong>
                        </p>
                        <p>
                            <ul>
                                @foreach($newsPost->categories as $category)
                                    <li>{{ $category->title }}</li>
                                @endforeach
                            </ul>
                        </p>
                        <hr>
                        <p>
                            @if($newsPost->is_analitics === 1)
                                <strong>Аналитическая статья</strong>
                            @else
                                <strong>Не аналитическая статья</strong>
                            @endif
                        </p>
                        <hr>
                        <h4>Теги</h4>
                        <ul>
                            @foreach($newsPost->tags as $tag)
                                <li><a href="{{ route('getTag', ['slug' => $tag->slug]) }}">{{ $tag->title }}</a></li>
                            @endforeach
                        </ul>
                        <hr>
                        <p><a href="{{ route('home') }}">Назад на главную</a></p>

                        <h4>Комментарии</h4>
                        <hr>
                        @foreach($newsPost->comments->sortByDesc('likes') as $comment)
                            @if($comment->publish == 1)
                                <div>
                                    <p><strong>Автор: {{ $comment->author->name }}</strong></p>
                                    <div>
                                        {{ $comment->body }}
                                    </div>
                                    <p><strong>Likes: {{ $comment->likes }}</strong></p>
                                    <form action="{{ route('addLike', ['comment' => $comment->id]) }}" class="form-horisontal" method="post">
                                        {!! csrf_field() !!}
                                        <fieldset>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-xs">+</button>
                                            </div>
                                        </fieldset>
                                    </form>
                                    <form action="{{ route('addDislike', ['commetn' => $comment->id]) }}" class="form-horisontal" method="post">
                                        {!! csrf_field() !!}
                                        <fieldset>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-warning btn-xs">-</button>
                                            </div>
                                        </fieldset>
                                    </form>
                                    <hr>
                                </div>
                            @endif
                        @endforeach
                        <h4>Добавить комментарий</h4>
                        <form action="{{ route('addComment', ['news' => $newsPost->id]) }}" class="form-horisontal" method="post">
                            {!! csrf_field() !!}
                            <fieldset>
                                <div class="form-group">
                                    <label for="body">Текст комментария</label>
                                    <textarea name="comment" id="news-body" rows="7" class="form-control content-editor"></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-flat">Добавить</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection