@extends('frontend.template')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found'))

@section('content')
<section class="banner" style="background-image:url({{ 'img/slide1.jpg' }});min-height:80vh">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="banner-heading">
                        <h2>{{__('Unknown request')}}</h2>
                    </div>
                    <div class="banner-link">
                        <ul>
                            <li>
                                <span class="active">{{__('Server has received a request it can not fulfill, please try again later')}}</span>
                            </li>
                        </ul>
                        <a href="{{url('/')}}" class="btn btn-theme bg-success mt-5">{{__('back to home')}} <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
