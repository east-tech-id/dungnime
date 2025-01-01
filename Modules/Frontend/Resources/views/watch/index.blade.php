@extends('frontend::layouts.app')

@section('content')
    <style>
        .embed-wrapper {
            position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;
        }
        .embed-iframe {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        }
    </style>
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{route('frontend.home')}}"><i class="fa fa-home"></i> Home</a>
                        @foreach($episode as $r_episode)
                        <span>{{$r_episode->title}}</span>
                        @endforeach
                    </div>
                </div>
            </div>
            <br><br>
            <div class="anime__details__episodes">
                <div class="section-title">
                    @foreach($episode as $r_episode)
                    <h5>Sedang Menonton {{$r_episode->title}}</h5>
                    @endforeach
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="product__page__filter">
                        <select onChange="window.location.href=this.value">
                             <option value="#">Pilih Episode</option>
                             @foreach($all_episode as $slug_episode)
                            <option value="{{$slug_episode->slug}}">{{$slug_episode->title}}</option>
                             @endforeach
                        </select>
                    </div>
               </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    
    <!-- Anime Section Begin -->
    <section class="anime-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="anime__video__player">
                        @foreach($episode as $r_episode)
                            @if($r_episode->embeds)
                                @php
                                    $server_selected = app('request')->input('server') ?? 0;
                                @endphp
                                <ul class="nav nav-pills mb-3">
                                @foreach($r_episode->embeds as $key => $emb)
                                    <li class="nav-item">
                                        <a class="nav-link {{ $server_selected == $key ? 'active' : '' }}"
                                           href="?server={{$key}}">Server {{$key + 1}}</a>
                                    </li>
                                @endforeach
                                </ul>
                                @if($r_episode->embeds[$server_selected] && $r_episode->embeds[$server_selected]['embed_link'] && $r_episode->embeds[$server_selected]['is_active'] == 'true')
                                    <div class="embed-wrapper">
                                        <iframe
                                                src="{{$r_episode->embeds[$server_selected]['embed_link']}}"
                                                class="embed-iframe"
                                                frameborder="0"
                                                allowfullscreen
                                        >
                                        </iframe>
                                    </div>
                                @else
                                    <div class="d-flex justify-content-center align-items-center" style="min-height: 200px;">
                                        <h4 style="color: white">Server {{$server_selected + 1}} tidak aktif</h4>
                                    </div>
                                @endif
                            @else
                                <video id="player" src="{{$r_episode->link_video}}"></video>
                            @endif
                        @endforeach
                    </div>
                    <!--  <div class="anime__details__episodes">
                        <div class="section-title">
                            <h5>Pilih Resolusi</h5>
                        </div>
                        <a href="#">720p</a>
                        <a href="#">1080p</a>
s
                    </div> -->

                </div>
            </div>
        </div>
    </section>
    
@endsection
