@extends('layouts.app')

@section('content')
    <div class="home my-n4">
        <section class="hero d-flex justify-content-center align-items-center">
            <div class="text-content container text-center text-light">
                <h1 class="animate__animated animate__fadeInDown font-weight-bold delay-1/2">We are making making online-friends cool again.</h1>
                <h5 class="my-4 animate__animated animate__fadeInDown animate__delay-half">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Maxime perferendis asperiores quidem sint debitis error nihil hic tempora reprehenderit veniam ad, quibusdam repellendus dignissimos magni nam mollitia quasi minima repudiandae.</h5>
                <button class="cta-btn text-light animate__animated animate__fadeInDown animate__delay-1s border-0 py-2 px-5"><h5 class="m-0">Read More</h5></button>
            </div>
        </section>

        <section class="info text-light">
            <div class="container h-100 d-flex justify-content-center align-items-center">
                <div class="col-md-4">
                    <img class="d-block w-100" src="{{ asset('images/undraw_friends.svg') }}" alt="">
                </div>
                <div class="col-md-8 text-right">
                    <h1>Lorem ipsum dolor sit amet consectetur.f.</h1>
                    <hr class="divider" />
                    <h5 class="subheading">Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum accusamus dicta ratione, ad iste recusandae.</h5>
                    <a href="{{route('register')}}" class="d-inline-block cta-btn bg-light text-dark font-semi-bold border-0 py-2 px-4 mt-4 rounded"><h5 class="m-0">SIGN UP</h5></a>
                </div>
            </div>
        </section>
    </div>
@endsection
