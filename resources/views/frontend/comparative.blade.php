@extends('frontend.template')
@section('content')
    <input style="display:none;" id="i18n" value="{{ __(app()->getLocale()) }}" />

    <section class="banner" style="background-image:url({{ asset('img/slide1.jpg') }});overflow:hidden;">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="banner-heading">
                        <h2>{{ __('Comparative Price Information') }}</h2>
                    </div>
                    <div class="banner-link">
                        <ul>
                            <li>
                                <a href="/">{{ __('Home') }}</a>
                            </li>
                            <li>
                                <span class="active">{{ __('Comparative Price Information') }}</span>
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
                        <h4>{{ __('You can compare prices for 2 given days by supplying them below:') }}</h4>
                        <div class="blog-detail-content">
                            <div class="para">
                                <div class="comment-box">
                                    <form id="queryFormDues" action="#" class="comment-form" method="POST">
                                        <input type="hidden" id="csrf" name="_token" value="{{ csrf_token() }}" />
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <input id="from" name="from"
                                                    class="form-control" type="date"
                                                    value="{{ $from ?? $from = \App\Models\commodityPriceDaily::getDateMax() }}">
                                            </div>
                                            <div class="col-sm-3">
                                                <input id="to" name="to"
                                                    class="form-control" type="date"
                                                    value="{{ $to ?? date('Y-m-d', strtotime($from . ' -180 days')) }}">
                                            </div>
                                            <div class="col-sm-3">
                                                <button id="submit" type="submit"
                                                    class="btn btn-theme comment-btn">{{ __('Check Prices') }}</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if(isset($data))
                <div class="col-md-12">
                    <div class="project-detail">
                        <h4 class="bottom-head">{{ __('Comparative Price Information') }}</h4>
                        <div class="pro-info">
                            <table id="commodityPriceParticular" class="display dt-large" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>{{ __('Commodity') }}</th>
                                        <th>{{ __('Average')  }} {{ __('Prices')}} : {{ str_replace('वि.सं. ', '', __date($from)) }}</th>
                                        <th>{{ __('Average')  }} {{ __('Prices')}} : {{ str_replace('वि.सं. ', '', __date($to)) }}</th>
                                        <th>{{ __('Difference %') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $index => $value)
                                        @php
                                            $currency = 'np' === __(app()->getLocale()) ? 'रू ' : 'Rs ';
                                        @endphp
                                        <tr>
                                            <td>{{ $value['id'] }} <span class="text-muted">({{ $value['unit'] }})</span></td>
                                            <td>{{ $currency . $value['from'] }}</td>
                                            <td>{{ $currency . $value['to'] }}</td>
                                            <td>
                                            @if(str_contains($value['diff'], '-') && __idf(0.00) . '%' !== (string) $value['diff'])
                                                <i class="fa fa-arrow-down text-danger"></i>
                                            @elseif (!str_contains($value['diff'], '-') && __idf(0.00) . '%' !== (string) $value['diff'])
                                                <i class="fa fa-arrow-up text-success"></i>
                                            @else
                                                <i class="fa fa-minus text-muted"></i>
                                            @endif
                                            {{ str_replace('-', '', $value['diff']) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
