@extends('index')

@section('main')
<section class="jumbotron text-center hello-block">
    <div class="container">
        <h1>Интернет-магазин</h1>
        <p class="lead text-muted">Попытка реализовать типовой проект интернет-магазина с главной страницей,<br> страницей пользователя, страницей регистрации и страницей товара</p>
    </div>
</section>
<div class="container">
    <div class="row">
        @for ($i=0;$i<6;$i++)
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Фото</text></svg>
                <div class="card-body">
                    <h2>Tesla Track</h2>
                    <p class="card-text">Стандартная модель будет использовать подстраивающуюся пневмоподвеску для компенсации вариаций в нагрузке и, также, будет иметь полный привод.</p>
                    <div class="d-flex justify-content-between">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-secondary">В корзину</button>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Подробнее</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endfor
    </div>
    <div class="row flex-nowrap justify-content-center align-items-center">
        <div class="col-2 text-center">
        <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
            <div class="btn-group mr-2" role="group" aria-label="First group">
                <button type="button" class="btn btn-secondary">1</button>
                <button type="button" class="btn btn-secondary">2</button>
                <button type="button" class="btn btn-secondary">3</button>
                <button type="button" class="btn btn-secondary">4</button>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
