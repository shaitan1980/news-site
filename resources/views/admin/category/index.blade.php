@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Список категорий</strong> <a href="{{ route('admin.category.create') }}" class="pull-right">Добавить новую</a></div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Название категории</th>
                                    <th>Редактировать</th>
                                    <th>Удалить</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.category.show', ['id' => $category->id]) }}">{{ $category->title }}</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.category.edit', ['id' => $category->id]) }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                                        </td>
                                        <td>
                                            <form class="frm-action" action="{{ route('admin.category.destroy', ['id' => $category->id]) }}"
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