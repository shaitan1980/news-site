@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Список новостей</strong> <a href="{{ route('admin.news.create') }}" class="pull-right">Добавить новую</a></div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Заголовок новости</th>
                                <th>Редактировать</th>
                                <th>Удалить</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($news as $post)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.news.show', ['id' => $post->id]) }}">{{ $post->title }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.news.edit', ['id' => $post->id]) }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                    </td>
                                    <td>
                                        <form class="frm-action" action="{{ route('admin.news.destroy', ['id' => $post->id]) }}"
                                              method="post" class="form-inline">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <input type="submit" onclick="return confirm('Удалить?')" class="btn btn-xs btn-danger" value="Удалить">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection