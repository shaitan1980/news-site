@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Список комментариев</strong></div>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Комментарий</th>
                                <th>Автор</th>
                                <th>Одобрить</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($comments as $comment)
                                <tr>
                                    <td>
                                        {!! $comment->body !!}
                                    </td>
                                    <td>
                                        {{ $comment->author->name }}
                                    </td>
                                    <td>
                                        <form class="frm-action" action="{{ route('admin.confirmComment', ['id' => $comment->id]) }}"
                                              method="post" class="form-inline">
                                            {{ csrf_field() }}
                                            <input type="submit"  class="btn btn-xs btn-success" value="Одобрить">
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