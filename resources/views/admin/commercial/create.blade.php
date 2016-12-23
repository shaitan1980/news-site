@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Новое рекламное объявление</strong></div>

                    <div class="panel-body">
                        <form action="{{ route('admin.commercial.store') }}" class="form-horisontal" method="post">
                            {!! csrf_field() !!}
                            <fieldset>
                                <div class="form-group">
                                    <label for="goog">Название товара</label>
                                    <input type="text" class="form-control" name="good" id="create-commerc-title" value="{{ old('good') }}">
                                </div>
                                <div class="form-group">
                                    <label for="seller">Продавец</label>
                                    <input type="text" class="form-control" name="seller" id="create-commerc-seller" value="{{ old('seller') }}">
                                </div>
                                <div class="form-group">
                                    <label for="website">Web site</label>
                                    <input type="text" class="form-control" name="website" id="create-commerc-website" value="{{ old('website') }}">
                                </div>
                                <div class="form-group">
                                    <label for="price">Цена</label>
                                    <input type="number" class="form-control" name="price" id="create-commerc-price" value="{{ old('price') }}">
                                </div>
                                <div class="form-group">
                                    <label for="kupon">Код купона скидки</label>
                                    <input type="text" class="form-control" name="kupon" id="create-commerc-kupon" value="{{ old('kupon') }}">
                                </div>
                                <div class="form-group">
                                    <label for="position">Выбор позиции на сайте</label>
                                    <select name="position" class="form-control" id="">
                                        <option value="left">Левая колонка</option>
                                        <option value="right">Правая колонка</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-flat">Создать</button>
                                    <a href="{{ route('admin.commercial.index') }}" class="btn btn-default btn-flat">Отменить</a>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection