@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('admin.commercial.index') }}">Назад к списку объявлений</a>
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Просмотр новости: </strong>{{ $commercial->title }}<a href="{{ route('admin.commercial.create') }}" class="pull-right">Добавить новую</a></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="page-header">{{ $commercial->good }}</h3>
                                <div class="form-group">
                                    <p><strong>Seller</strong></p>
                                    <p>{{ $commercial->seller }}</p>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <p><strong>Website</strong></p>
                                    <p>{{ $commercial->website }}</p>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <p><strong>Price</strong></p>
                                    <p>{{ $commercial->price }}</p>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <p><strong>Sale kupon</strong></p>
                                    {{ $commercial->kupon }}
                                </div>
                                <hr>
                                <div class="form-group">
                                    <p><strong>Position</strong></p>
                                    {{ $commercial->position }}
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection