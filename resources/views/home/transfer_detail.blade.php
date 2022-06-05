@extends('layouts.home')

@section('title', 'Transfer Detayları '.$data->title)

@section('description'){{$data->description}}@endsection

@section('keywords',$data->description)
@include('home._header')
@section('content')
    <!--/ Intro Single star /-->
    <section class="intro-single">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="title-single-box">
                        <h1 class="title-single">{{$data->title}}</h1>
                        <span class="color-text-a">{{$data->category->title}}</span>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">

                </div>
            </div>
        </div>
    </section>
    <!--/ Intro Single End /-->

    <!--/ Property Single Star /-->
    <section class="property-single nav-arrow-b">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="property-single-carousel" class="owl-carousel owl-arrow gallery-property">
                        @foreach($images as $rs)
                        <div class="carousel-item-b">
                            <img src="{{ Storage::url($rs->image) }}" style="height: 600px;" alt="">
                        </div>
                        @endforeach
                    </div>
                    <div class="row justify-content-between">
                        <div class="col-md-5 col-lg-4">
                            <div class="property-price d-flex justify-content-center foo">
                                <div class="card-header-c d-flex">
                                    <div class="card-box-ico">
                                        <span class="ion-money">₺</span>
                                    </div>
                                    <div class="card-title-c align-self-center">
                                        <h5 class="title-c">{{$data->base_price}}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row section-t3">
                                <div class="col-sm-12">
                                    <div class="title-box-d">
                                        <h3 class="title-d">Rezervasyon Yap</h3>
                                    </div>
                                </div>
                            </div>
                            @php
                                $amount=0;
                            @endphp
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="property-contact">
                                        <form class="form-a" action="{{route('sendreserve',['id'=>$data->id,'slug'=>$data->slug])}}" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12 mb-1">
                                                    <div class="form-group">
                                                        <h4><b>UÇUŞ TARİHİ</b></h4>
                                                        <input type="date" class="form-control form-control-lg form-control-a" id="flightDate" name="flightDate"
                                                               required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-1">
                                                    <div class="form-group">
                                                        <h4><b>UÇUŞ SAATİ</b></h4>
                                                        <input type="time" class="form-control form-control-lg form-control-a" id="flightTime" name="flightTime"
                                                               required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-1">
                                                    <div class="form-group">
                                                        <h4><b>PICK UP TIME</b></h4>
                                                        <input type="time" class="form-control form-control-lg form-control-a" id="pickupTime" name="pickupTime"
                                                               required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-1">
                                                    <div class="form-group">
                                                        <th><b>Nereden</b></th>
                                                            <td>
                                                                <select name="fromlocation" id="fromlocation">
                                                                    @foreach($location as $rs)
                                                                    <option>{{$rs->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                    </div>

                                                <div class="col-md-12 mb-1">
                                                    <div class="form-group">
                                                        <th><b>Nereye</b></th>
                                                            <td>
                                                                <select name="tolocation" id="tolocation">
                                                                    @foreach($location as $rs)
                                                                        <option>{{$rs->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                    </div>
                                                </div>



                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-a">Rezervasyon Yap</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="property-summary">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="title-box-d section-t4">
                                            <h3 class="title-d">Yorumlar</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="summary-list">

                                    <div class="box-comments">
                                        <ul class="list-comments">
                                            @foreach($reviews as $rs)
                                            <li>

                                                <div class="comment-details">
                                                    <h4 class="comment-author">{{$rs->user->name}}</h4>
                                                    <span>{{$rs->created_at}}</span>
                                                    <p class="comment-description">
                                                        {{$rs->review}}
                                                    </p>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="row section-t3">
                                    <div class="col-sm-12">
                                        <div class="title-box-d">
                                            <h3 class="title-d">Yorum Yap</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="property-contact">
                                            <form class="form-a" action="{{route('sendreview',['id'=>$data->id,'slug'=>$data->slug])}}" method="post">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-12 mb-1">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-lg form-control-a" id="subject" name="subject"
                                                                   placeholder="Subject" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mb-1">
                                                        <div class="form-group">
                                                            <textarea id="review" class="form-control" placeholder="Review" name="review" cols="45" rows="8" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn btn-a">Yorum Yap</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="col-md-7 col-lg-7 section-md-t3">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="title-box-d">
                                        <h3 class="title-d">Detaylar</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="property-description">
                                <p class="description color-text-a">
                                    {!! $data->detail !!}
                                </p>
                            </div>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
    <!--/ Property Single End /-->


@endsection
