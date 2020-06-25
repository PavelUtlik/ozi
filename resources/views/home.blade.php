@extends('index')

@section('posts')

    <div class="container mb-2">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                <h2 class="mb-4">Фильтр товаров</h2>

                <label >Сортировать по цене</label>
                <button type="submit" class="btn btn-primary btn-sort" data-subject="price" data-type="desc">Убыванию</button>

                <button type="submit"  class="btn btn-primary btn-sort" data-subject="price" data-type="asc">Возрастанию</button>


                <label >Сортировать по количеству комнат</label>

                <button type="submit" class="btn btn-primary btn-sort" data-subject="qty_room" data-type="desc">Убыванию</button>

                <button type="submit"  class="btn btn-primary btn-sort" data-subject="qty_room" data-type="asc">Возрастанию</button>
            </div>

        </div>
    </div>

    <div class="container">
        <div class="row" id="posts">
            @foreach($posts as $post)
            <div class="col-md-4 card" data-price="{{$post->price}}" data-qty_room = "{{ $post->qty_room }}">
                    <div style="width: 20rem;">
                        <img class="card-img-top" src="{{$post->image}}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{$post->title}}</h5>
                            <p class="card-text">{{$post->description}}</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Цена: {{$post->price}} рублей в сутки</li>
                            <li class="list-group-item">Контакты: {{$post->contact}}</li>
                            <li class="list-group-item">Количество комнат: {{$post->qty_room}}</li>
                            <li class="list-group-item">Дата обновления: {{$post->update_date}}</li>
                        </ul>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>






@stop
