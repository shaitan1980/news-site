@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Редактирование категории: </strong>{{ $category->title }}</div>
                    <div class="panel-body">
                        <form action="{{ route('admin.category.update', ['id' => $category->id]) }}" class="form-horisontal" method="post">
                            {{ method_field('PUT') }}
                            {!! csrf_field() !!}
                            <fieldset>
                                <div class="form-group">
                                    <label for="title">Название категории</label>
                                    <input type="text" class="form-control" name="title" id="create-cat-title" value="{{ $category->title }}">
                                </div>
                                <div class="form-group">
                                    <label for="slug">ЧПУ ссылка</label>
                                    <input type="text" class="form-control" name="slug" id="create-cat-slug" value="{{ $category->slug }}">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-flat">Обновить</button>
                                    <a href="{{ route('admin.category.index') }}" class="btn btn-default btn-flat">Отменить</a>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection