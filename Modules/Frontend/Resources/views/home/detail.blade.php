@extends('frontend::layouts.app')

@section('content')
    <!-- Breadcrumb Begin -->
    <!-- <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                        <a href="./categories.html">Categories</a>
                        <span>Romance</span>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Breadcrumb End -->

    <!-- Anime Section Begin -->
    @if(!empty($anime_detail))
        <section class="anime-details spad">
            <div class="container">
                <div class="anime__details__content">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="anime__details__pic set-bg" data-setbg="{{$anime_detail->url_thumbnail}}">
                                <!-- <div class="comment"><i class="fa fa-comments"></i> 11</div> -->
                                <!-- <div class="view"><i class="fa fa-eye"></i> 9141</div> -->
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="anime__details__text">
                                <div class="anime__details__title">
                                    <h3>{{$anime_detail->title}}</h3>
                                    <!-- <span>フェイト／ステイナイト, Feito／sutei naito</span> -->
                                </div>
                              <!--   <div class="anime__details__rating">
                                    <div class="rating">
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star"></i></a>
                                        <a href="#"><i class="fa fa-star-half-o"></i></a>
                                    </div>
                                    <span>1.029 Votes</span>
                                </div> -->
                                <p>{{$anime_detail->description}}</p>
                                <div class="anime__details__widget">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <ul>
                                                <li><span>Rating</span> {{$anime_detail->rating}} <i class="fa fa-star text-warning"></i></li>
                                                <li><span>Status</span> {{$anime_detail->status}}</li>
                                                <li><span>Genre</span>
                                                @if(!empty($anime_detail->genre))
                                                    @foreach($anime_detail->genre as $genre)
                                                        @if($loop->first)
                                                            <a href="#" class="btn btn-sm btn-secondary text-white mr-1" style="border-radius: 40px !important;">{{ $genre }}</a>
                                                        @else
                                                            <a href="#" class="btn btn-sm btn-secondary text-white mx-1" style="border-radius: 40px !important;">{{ $genre }}</a>
                                                        @endif
                                                    @endforeach
                                                @endif
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="anime__details__btn">
                                    @if(!empty($anime_detail[0]->episode[0]))
                                        <a href="{{route('frontend.watch',[$anime_detail[0]->slug,$anime_detail[0]->episode[0]->slug])}}" class="watch-btn"><span>Tonton Sekarang <i class="fa fa-angle-right"></i></span></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="recent__product">
                        <div class="row">
                            <div class="col-12">
                                <div class="section-title">
                                    <h4>All Episodes</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @if(!empty($anime_detail->episodes))
                                @foreach($anime_detail->episodes as $r_recent)
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <div class="product__item">
                                            <a href="{{ route('frontend.watch',[$r_recent->anime->slug,$r_recent->slug]) }}" class="text-decoration-none">
                                                <div class="product__item__pic set-bg" data-setbg="{{$r_recent->anime->url_thumbnail}}">
                                                    <div class="ep">{{$r_recent->anime->rating}}</div>
                                                    <!-- <div class="comment"><i class="fa fa-comments"></i> 11</div> -->
                                                    <div class="view"></i>{{$r_recent->anime->status}}</div>
                                                </div>
                                            </a>
                                            <div class="product__item__text">
                                                <a href="{{ route('frontend.watch',[$r_recent->anime->slug,$r_recent->slug]) }}" class="text-decoration-none">
                                                    <span class="title-anime text-white">{{$r_recent->title}}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- Anime Section End -->
@endsection

