@extends('user.layout')
@section('title')
  Fashion 
@endsection
@section('content')
    {{-- Slider --}}

    <div class="flex home_user  " style="background-image: url({{ asset('images/bg1.jpg') }});  filter: brightness(0.9);">
        <div class="text_slider">
        </div>
        <div class="slider_animation">
            <img src="{{ asset('images/ani1.png') }}" alt="slider1" class="ani1">
            <div class="img_slider slider1" style="background-image: url('{{ asset('images/slider1.png') }}')"></div>
            <img src="{{ asset('images/ani2.png') }}" alt="slider2" class="ani2">
            <div class="img_slider slider2" style="background-image: url('{{ asset('images/slider2.png') }}')"></div>
            <img src="{{ asset('images/ani3.png') }}" alt="slider3" class="ani3">
            <div class="img_slider slider3" style="background-image: url('{{ asset('images/slider3.png') }}')"></div>
        </div>
    </div>
    {{-- Brand --}}

    <div class="brand_home">
        <h3> Brand Fashion </h3>
        <div class="brand">
            <div class="container">
                <div class="wrapper flexitem">
                    @foreach ($brands as $brand)
                        <div class="item">
                            <a href="{{ url('brand/' . $brand->id) }}">
                                <img src="{{ $brand->logo }}" alt="{{ $brand->name }}">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Trending Product --}}

    <div class="trending">
        <div class="container">
            <div class="wrapper">
                <div class="sectop flexitem">
                    <h2><span class="circle"></span><span>Trending Products</span></h2>
                </div>
                <div class="column">
                    <div class="flexwrap">
                      
                    </div>
                    <div class="row products mini">
                            
                        </div>
                        <div class="row products mini">
                            
                        </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    {{-- Product --}}

    <div class="features">
        <div class="container">
            <div class="wrapper">
                <div class="column">
                    <div class="sectop flexitem">
                        <h2><span class="circle"></span><span>View Products</span></h2>
                        <div class="second_links"><a href="{{url('viewAllProducts')}}" class="view_all">Xem tất cả<i
                                    class="ri-arrow-right-line"></i></a></div>
                    </div>
                    <div class="products main flexwrap">
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
 
@endsection

@section('modal')
    <div id="modal" class="modal">
        <div class="content flexcol">
            <div class="image object_cover">
                <img src="{{asset('images/apparel4.jpg')}}">
            </div>
            <h2>Chào mừng đến với Fashion</h2>
            <p class="mobile_hide">Web Fashion E-commerce
                <br>
                Nhanh tay nhanh tay! Nhận ngay deal hot
            </p>
            <form action="" class="search">
                <span class="icon-large"><i class="ri-mail-line"></i></span>
                <input type="email" name="email" placeholder="Email của bạn" style="width:85%;padding: 0 2em 0 4.5em;">
                <button>Đăng kí</button>
            </form>
            <a href="" class="mini_text again">Không show nó lần nữa</a>
            <a href="#" class="t_close modalclose flexcenter">
                <i class="ri-close-line"></i>
            </a>
        </div>
    </div>
    <div class="overlay"></div>
@endsection
@section('javascript')
    <script>
        if(window.sessionStorage.getItem('close')){
            window.onload = function(){
            document.querySelector('.site').classList.remove('showmodal')    
            }; 
        }else{
            window.onload  = function (){
            document.querySelector('.site').classList.toggle('showmodal')
        };
        }
        document.querySelector('.modalclose').addEventListener('click', function(){
            document.querySelector('.site').classList.remove('showmodal')
        });


        document.querySelector('.again').addEventListener('click', function(e){
            e.preventDefault();
            window.sessionStorage.setItem('close','showmodal');
            document.querySelector('.site').classList.remove('showmodal');
        });
        //Phần deal of day
        let countDate = new Date('29,Jun,2023 00:00:00').getTime();

        function countDown() {
            let now = new Date().getTime();

            gap = countDate - now;

            let seconds = 1000;
            let minutes = seconds * 60;
            let hours = minutes * 60;
            let day = hours * 24;
            let d = Math.floor(gap / (day)) < 10 ? '0' + Math.floor(gap / (day)) : Math.floor(gap / day);
            let h = Math.floor((gap % (day)) / (hours)) < 10 ? '0' + Math.floor((gap % (day)) / (hours)) : Math.floor((gap %
                (day)) / (hours));
            let m = Math.floor((gap % (hours)) / (minutes)) < 10 ? '0' + Math.floor((gap % (hours)) / (minutes)) : Math
                .floor((gap % (hours)) / (minutes));
            let s = Math.floor((gap % (minutes)) / (seconds)) < 10 ? '0' + Math.floor((gap % (minutes)) / (seconds)) : Math
                .floor((gap % (minutes)) / (seconds));

            document.querySelector('.days').innerText = d;
            document.querySelector('.hours').innerText = h;
            document.querySelector('.minutes').innerText = m;
            document.querySelector('.seconds').innerText = s;


        }
        setInterval(() => {
            countDown()
        }, 1000);
    </script>
@endsection
