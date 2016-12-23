@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Новый тег</strong></div>

                    <div class="panel-body">
                        <form action="{{ route('admin.tag.store') }}" class="form-horisontal" method="post">
                            {!! csrf_field() !!}
                            <fieldset>
                                <div class="form-group">
                                    <label for="title">Заголовок тега</label>
                                    <input type="text" class="form-control" name="title" id="create-cat-title" value="{{ old('title') }}">
                                </div>
                                <div class="form-group">
                                    <label for="slug">ЧПУ ссылка</label>
                                    <input type="text" class="form-control" name="slug" id="create-cat-slug" value="{{ old('slug') }}">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-flat">Создать</button>
                                    <a href="{{ route('admin.tag.index') }}" class="btn btn-default btn-flat">Отменить</a>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection