@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('admin.news.index') }}">Назад к списку новостей</a>
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Просмотр новости: </strong>{{ $news->title }}<a href="{{ route('admin.news.create') }}" class="pull-right">Добавить новую</a></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-9">
                                <h3 class="page-header">{{ $news->title }}</h3>
                                <div class="form-group">
                                    <p><strong>ЧПУ ссылка</strong></p>
                                    <p>{{ url('news/' . $news->slug) }}</p>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <p><strong>Текст новости</strong></p>
                                    {!! $news->body !!}
                                </div>
                                <hr>
                                <div class="form-group">
                                    <p><strong>Изображение</strong></p>
                                    <img src="{{ $news->image }}" alt="{{ $news->title }}" class="img-responsive">
                                </div>
                                <hr>
                                <div class="form-group">
                                    <p><strong>Автор</strong></p>
                                    {{ $news->author->name }}
                                </div>
                                <hr>
                                <div class="form-group">
                                    <p><strong>Количество просмотров</strong></p>
                                    {{ $news->read }}
                                </div>
                                <hr>
                                <div class="form-group">
                                    <p><strong>Аналитическая статья?</strong></p>
                                    @if( $news->is_analitics === 1 )
                                        Да
                                    @else
                                        Нет
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <p><strong>Категория</strong></p>
                                    <ul>
                                        @foreach( $news->categories as $cat)
                                            <li>{{ $cat->title }}</li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="form-group">
                                    <p><strong>Теги</strong></p>
                                    <ul>
                                        @foreach( $news->tags as $tag)
                                            <li>{{ $tag->title }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection