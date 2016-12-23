@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Список тегов</strong> <a href="{{ route('admin.tag.create') }}" class="pull-right">Добавить новый</a></div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Заголовок тега</th>
                                <th>Редактировать</th>
                                <th>Удалить</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($tags as $tag)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.tag.show', ['id' => $tag->id]) }}">{{ $tag->title }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.tag.edit', ['id' => $tag->id]) }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                    </td>
                                    <td>
                                        <form class="frm-action" action="{{ route('admin.tag.destroy', ['id' => $tag->id]) }}"
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