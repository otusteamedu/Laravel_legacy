{{-- Имя данного файла --}}
@section('pageName', 'katalog')

{{-- Унаследуй layout файл --}}
@extends('layouts.default')

{{-- Передай значение в тэг <title></title> внутри layout'a --}}
@section('pageTitle', 'Интернет-магазин фруктов')

@section('pageContent')
    <main>    
        <p>/katalog</p>
        <h4>Каталог</h4>

        @php
            // включаем файл, внутри которого описывается массив $product
            // массив содержит данные о товаре (фруктах)
            include 'php/products.php';                     
        @endphp

        @foreach ($product as $fruit)
        <div class="card">
            <h5>{{ $fruit['name'] }}</h5>
            <div><img src="img/fruits/{{ $fruit['src']}}"></div>
                <div class="description">
                    <p>{{ $fruit['description']}}</p>
                </div>
            <p>Цена за кг : {{ $fruit['price']}} руб.</p>
        </div>
        @endforeach   
            
  
    </main>
    
@endsection
