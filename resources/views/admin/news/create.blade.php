@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Добавление новости</strong></div>

                    <div class="panel-body">
                        <form action="{{ route('admin.news.store') }}" class="form-horisontal" method="post">
                            {!! csrf_field() !!}
                            <fieldset>
                                <div class="form-group">
                                    <label for="title">Заголовок новости</label>
                                    <input type="text" class="form-control" name="title" id="create-news-title" value="{{ old('title') }}">
                                </div>
                                <div class="form-group">
                                    <label for="slug">ЧПУ ссылка</label>
                                    <input type="text" class="form-control" name="slug" id="create-news-slug" value="{{ old('slug') }}">
                                </div>
                                <div class="form-group">
                                    <label for="body">Текст новости</label>
                                    <textarea name="body" id="news-body" rows="15" class="form-control content-editor">{{ old('body') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="image">Изображение</label>
                                    <div class="input-group">
                                  <span class="input-group-btn">
                                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                      <i class="fa fa-picture-o"></i> Выбрать
                                    </a>
                                  </span>
                                        <input id="thumbnail" class="form-control" type="text" name="image" value="{{ old('image') }}">
                                    </div>
                                    <img id="holder" style="margin-top:15px;max-height:100px;">
                                </div>
                                <div class="form-group">
                                    <label for="author_id">Автор</label>
                                    <input type="text" class="form-control" name="author_id" id="create-news-author" value="{{ Auth::user()->name }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="category">Выбор категории</label>
                                    <select name="category" class="form-control" id="">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Аналитическая статья?</label>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="is_analitics" id="is_analitics1" value="0" checked>
                                            Нет
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="is_analitics" id="is_analitics2" value="1">
                                            Да
                                        </label>
                                    </div>
                                </div>
                                <div class="checkbox">
                                    <p><strong>Выбрать теги</strong></p>
                                    @foreach($tags as $tag )
                                        <label>
                                            <input type="checkbox" name="tag[]" value="{{ $tag->id }}">
                                            {{ $tag->title }}
                                        </label>
                                    @endforeach
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-flat">Создать</button>
                                    <a href="{{ route('admin.news.index') }}" class="btn btn-default btn-flat">Отменить</a>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection