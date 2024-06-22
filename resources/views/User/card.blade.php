@extends('layouts.header_footer')
@section('title')
    card
@endsection
@section('content')
    <body>
        <div class="container">
            @if(session('success'))
            <br><br><br><br>
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

        <!-- //////start nav////////////////////////////////////////////////////////////////// -->
        <!-- ///////end nav///////////////////////////////////////////////////////////////// -->
            @if (!(array)session('cart'))
            <br><br><br><br>
                <h5 style="color:blue"> *your cart is empty  go to home page and put your order  in cart</h5>
            @else
            <br>
            <div class="container w-75  bg-secondary-subtle mt-5  py-3 d-flex flex-wrap justify-content-between">
                <div class="left d-flex flex-wrap ">
                    <h2 class="w-100">MY CARTS </h2>
                </div>
                        <div class="right mt-1">
                            {{-- <button class="btn btn-danger"><a href="{{route('delete.cart')}}">Clear</a></button> --}}
                        </div>
                        <div class="cartContent d-flex flex-wrap  col-12 d-flex justify-content-between ">
                            @foreach ((array)session('cart') as $item)
                                <div class="cartLeft col-8 ">
                                    <div class="container mt-3 d-block rounded-2  ">
                                        <div class="d-flex gap-3">
                                            <div class="left-img col-4 ">
                                                <img class="w-100 " src="{{url($item['photo'])}}" alt="image">
                                            </div>
                                            <div class="left-caption align-content-center">
                                                <h3>{{$item['description']}}</h3>
                                                {{-- <h5 >{{$item['']}}</h5> --}}
                                                <p class="h5">Price {{$item['price']}} $</p>
                                                <button   class="btn m-0 p-0 text-danger  cart_remove"><i class="fa-solid fa-trash-can cursor-pointer py-2 ps-1"><a href="{{route('delet.card',['item' => $item['id']])}}">remove</a></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="cartRight col-4 text-end d-flex gap-1 justify-content-end align-items-center">
                                    <a class="fa fa-minus-circle text-success " aria-hidden="false" ></a>
                                    <p class="mt-3">{{$item['qunantity']}}</p>
                                    <i class="fa fa-plus-circle text-success"   aria-hidden="true" ></i>
        
                                </div> --}}
                                <div class="counter cartRight col-4 text-end d-flex gap-1 justify-content-end align-items-center">

                                    <button class="decrementButton">-</button>
                                    <span class="countDisplay">{{$item['qunantity']}}</span>
                                    <button class="incrementButton">+</button>
                                </div>
                            @endforeach
                    </div>
                    <div class="left d-flex flex-wrap "> 
                            <h3>
                                @php
                                    $total = 0 
                                @endphp
                                @foreach ((array)session('cart')  as $item )
                                    @php
                                        $total+= $item['price'] * $item['qunantity']
                                    @endphp
                                @endforeach
                                <p>total price : {{$total}} $</p>
                            </h3>
                    </div>
            </div>
            <div class="text-center bg-secondary-subtle w-75 m-auto pb-3">
                <a href="payment/stripe"><button class="btn btn-success ">Check Out</button></a>
            </div>
            @endif

        <!-- ================================= -->
        
        <!-- start footer -->
        <!-- end footer -->
        

        <script src="{{asset('./js/bootstrap.bundle.min.js')}}"></script>
        <script type="text/javascript">
            $(".cart_remove").click(function (e) {
            e.preventDefault();
        
            var ele = $(this);
        
            if(confirm("Do you really want to remove?")) 
            {
                $.ajax({
                    url: '{{ route('remove_from_cart') }}',
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}', 
                        id: ele.parents("tr").attr("data-id")
                    },
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
    });
        </script>
    </body>
    </html>
@endsection