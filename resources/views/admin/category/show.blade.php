@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('admin.category.index') }}">Назад к списку категорий</a>
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Просмотр категории: </strong>{{ $category->title }}<a href="{{ route('admin.category.create') }}" class="pull-right">Добавить новую</a></div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Название категории</th>
                                <th>ЧПУ ссылка</th>
                                <th>Дата создания</th>
                            </tr>
                            </thead>
                            <tbody>
                                <td>
                                    {{ $category->title }}
                                </td>
                                <td>
                                    {{ url('category/' . $category->slug) }}
                                </td>
                                <td>
                                    {{ $category->created_at }}
                                </td>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection