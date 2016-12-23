@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Панель администратора</strong></div>

                <div class="panel-body">
                    <p><a href="{{ route('admin.category.index') }}">Список категорий</a></p>
                    <p><a href="{{ route('admin.tag.index') }}">Список тегов</a></p>
                    <p><a href="{{ route('admin.news.index') }}">Список новостей</a></p>
                    <p><a href="{{ route('admin.commercial.index') }}">Список рекламных объявлений</a></p>
                    <p><a href="{{ route('admin.comment.index') }}">Список комментариев, ожидающих одобрения</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
