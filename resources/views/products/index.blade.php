@extends('products.layout')
@section('content')

<body class="">
    <section>
        <h1 class="text-center">Shopping</h1>
    </section>

<!-- ตะกร้าสินค้า -->
    <section id="cart" style="display: none;">
        <b style="display: none;">{{$i=1}}</b>

        @foreach ($data as $value)
        <div class="t" id="cart{{$value->id}}" style="display: none;">
            <img src="{{ $value->img}}" alt="">
            <b>{{ $value->name}}</b>
            <b id="a{{$i++}}" price="{{$value->price}}">{{$value->price}}</b>
            <input type="number" min="1" value="0" id="qty{{$value->id}}">
            <button class="del btn btn-danger">ลบสินค้า</button>
        </div>
        @endforeach

        <div class="border-bottom">
            <h3 class="d-inline">ราคารวม</h3>
            <h3 class="d-inline" id="total">0</h3>
        </div>

    </section>
<!-- จบตะกร้าสินค้า -->

<!-- รายการสิรค้า -->
    <br>
    <section id="list" class="contriner ">
        <div class="shop-content">
        @foreach ($data as $value)
        <div class="add border p-2 m-2" cart="cart{{$value->id}}" pri="{{ $value->price}}" qty="qty{{$value->id}}">
            <img src="{{ $value->img}}" alt="">
            <h2>{{ $value->name}}</h2>
            <span>{{ $value->price}}</span>
        </div>
        @endforeach
        </div>
    </section>
<!-- จบรายการสินค้า -->

</body>
@endsection

@section('script')
<script src="{{asset('js/product.js')}}"></script>
@endsection