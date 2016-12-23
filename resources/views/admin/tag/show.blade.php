@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('admin.tag.index') }}">Назад к списку тегов</a>
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Просмотр тега: </strong>{{ $tag->title }}<a href="{{ route('admin.tag.create') }}" class="pull-right">Добавить новый</a></div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Название</th>
                                <th>ЧПУ ссылка</th>
                                <th>Дата создания</th>
                            </tr>
                            </thead>
                            <tbody>
                            <td>
                                {{ $tag->title }}
                            </td>
                            <td>
                                {{ url('tag/' . $tag->slug) }}
                            </td>
                            <td>
                                {{ $tag->created_at }}
                            </td>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection