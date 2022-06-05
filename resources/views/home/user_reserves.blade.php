@extends('layouts.home')
@php
    $setting=\App\Http\Controllers\HomeController::getsetting();
@endphp

@section('title', 'Rezervasyonlarım | '.$setting->title)
@include('home._header')
@section ('content')
    <!--/ Testimonials Star /-->
    <section class="section-testimonials section-t8 nav-arrow-a">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-wrap d-flex justify-content-between">
                        <div class="title-box">
                            <h2 class="title-a">Rezervasyonlarım</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div id="testimonial-carousel" class="owl-carousel owl-arrow">

                <div class="carousel-item-a">
                    @foreach($datalist as $rs)
                    <div class="testimonials-box">

                        <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <a href="{{route('transfer',['id' => $rs->transfer->id,'slug' => $rs->transfer->slug])}}">{{$rs->transfer->title}}</a>
                                    <div class="testimonial-img">
                                        <img src="{{ Storage::url($rs->transfer->image) }}" style="height: 300px; width: 300px;" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="testimonial-ico">
                                        <span class="ion-ios-quote"></span>
                                    </div>
                                    <div class="testimonials-content">
                                        <p class="testimonial-text">
                                            FLIGHT TIME:<b>{{$rs->flightTime}}</b><br>
                                            PICKUP TIME:<b>{{$rs->pickupTime}}</b> <br>
                                            FROM:<b>{{$rs->fromlocation}}</b> <br>
                                            TO:<b>{{$rs->tolocation}}</b> <br>
                                            NOTE:<b>{{$rs->note}}</b> <br>

                                            OLUŞTURULMA TARİHİ:{{$rs->created_at}}<br>
                                            REZERVASYON DURUMU:{{$rs->status}}<br>
                                        </p>
                                    </div>
                                    <div class="testimonial-author-box">
                                        <h5 class="testimonial-author">FİYAT:{{$rs->transfer->base_price}} ₺</h5>
                                        <h5 class="testimonial-author">UÇUŞ TARİHİ:{{$rs->flightDate}}</h5>
                                    </div>
                                </div>
                        </div>

                    </div>
                @endforeach
                </div>

            </div>
        </div>
    </section>
    <!--/ Testimonials End /-->

@endsection

