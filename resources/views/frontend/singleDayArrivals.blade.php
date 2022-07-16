@extends('frontend.template')
@section('content')
    <input style="display:none;" id="i18n" value="{{ __(app()->getLocale()) }}" />

    <section class="banner" style="background-image:url({{ asset('img/slide1.jpg') }});overflow:hidden;">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="banner-heading">
                        <h2>{{ __('Daily Arrival') }}</h2>
                    </div>
                    <div class="banner-link">
                        <ul>
                            <li>
                                <a href="/">{{ __('Home') }}</a>
                            </li>
                            <li>
                                <span class="active">{{ __('Daily Arrival') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="blog sp-70-100">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-md-push-3">
                    <div class="blog-detail">
                        <h4>{{ __('Daily Arrival') }} {{ __('Information') }}</h4>
                        <div class="blog-detail-content">
                            <ul class="post-detail-meta" style="border-top:none;">
                                <li>
                                    <a href="#">
                                        <i
                                            class="fa fa-user"></i>{{ __('Kalimati Fruits and Vegetable Market Development Board') }}
                                    </a>
                                </li>
                            </ul>
                            <div class="para">
                                <div class="comment-box">
                                    <form id="queryFormDues" action="#" class="comment-form" method="POST">
                                        <input type="hidden" id="csrf" name="_token" value="{{ csrf_token() }}" />
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <input id="datePricing" name="datePricing"
                                                    class="form-control datePricing-{{ __(app()->getLocale()) }}"
                                                    placeholder="{{ __('Date for arrival') }}" type="date" value="{{ \App\Models\commodityPriceDaily::getMaxDateArrivalCommodity() }}">
                                            </div>
                                            <div class="col-sm-3">
                                                <button type="submit"
                                                    class="btn btn-theme comment-btn">{{ __('Check Arrival Data') }}</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="project-detail">
                        <h4 class="bottom-head">{{ __('Daily Arrival') }}
                            {{ isset($date) ? " - $date" : '' }}</h4>
                        <div class="pro-info">
                            <table id="commodityPriceParticular" class="display dt-large" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>{{ __('Commodity') }}</th>
                                        <th>{{ __('Unit') }}</th>
                                        <th>{{ __('Quantity') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (App\Models\Backend\ArrivalLog::getArrivals(isset($paramDate) ? $paramDate : null) as $index => $value)
                                        <tr>
                                            <td>{{ $value->commodityname }}</td>
                                            <td>{{ $value->commodityunit }}</td>
                                            <td>{{ __idf($value->quantity) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
