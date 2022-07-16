@extends('frontend.template')
@section('content')
    <section class="top-slider pt-1">
        <div class="container-fluid">
            <div class="row row-eq-height">
                <div class="col-lg-9 col-md-9 col-sm-12">
                    <section class="top-slider">
                        <div class="theme-slider main-slider owl-carousel owl-theme" data-items="1" data-loop="true" data-pause-on-hover="true" data-autoplay="true"
                            data-dots="true" data-nav="true" data-r-x-small="1" data-r-x-small-nav="false" data-r-x-small-dots="true" data-r-x-medium="1"
                            data-r-x-medium-nav="false" data-r-x-medium-dots="true" data-r-small="1" data-r-small-nav="false" data-r-small-dots="true"
                            data-r-medium="1" data-r-medium-nav="true" data-r-medium-dots="true" data-r-large="1" data-r-large-nav="true" data-r-large-dots="true">
                            <div class="item">
                                <img src="{{ asset('img/slide1.jpg') }}" alt="slide">
                            </div>

                            <div class="item">
                                <img src="{{ asset('img/slide2.jpg') }}" alt="slide">
                            </div>

                            <div class="item">
                                <img src="{{ asset('img/slide3.jpg') }}" alt="slide">
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12 side-team">
                    <div class="team-sidenav">
                      <img src="{{ setting()->get('chairperson_image','https://place-hold.it/400x400') }}" alt="{{__('Chair Person')}}">
                      <div>
                        <span>{{__('board_members.chairperson')}}</span>
                        {{__('Chair Person')}}
                        <ul class="social social-header">
                            @if(setting()->get('chairperson_email', false))
                            <li>
                                <a class="link-blue" href="mailto:{{ setting()->get('chairperson_email', false) }}">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </li>
                            @endif
                            @if(setting()->get('chairperson_email', false))
                            <li>
                                <a class="link-blue" href="tel:{{ setting()->get('chairperson_phone', false) }}">
                                    <i class="fas fa-phone"></i>
                                </a>
                            </li>
                            @endif
                        </ul>
                      </div>
                    </div>
                    <div class="team-sidenav">
                      <img src="{{ setting()->get('executive_image', 'https://place-hold.it/400x400') }}" alt="{{__('Executive Director')}}">
                      <div>
                        <span>{{__("board_members.executive_director")}}</span>
                        {{__('Executive Director')}}
                        <ul class="social social-header">
                            @if(setting()->get('executive_email', false))
                            <li>
                                <a class="link-blue" href="mailto:{{ setting()->get('executive_email', false) }}">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </li>
                            @endif
                            @if(setting()->get('executive_email', false))
                            <li>
                                <a class="link-blue" href="tel:{{ setting()->get('executive_phone', false) }}">
                                    <i class="fas fa-phone"></i>
                                </a>
                            </li>
                            @endif
                        </ul>
                      </div>
                    </div>
                    <div class="team-sidenav">
                      <img src="{{ setting()->get('deputy_image', 'https://place-hold.it/400x400') }}" alt="{{__('Information Officer')}}">
                      <div>
                        <span>{{__('board_members.deputy_director')}}</span>
                        {{__('Information Officer')}}
                        <ul class="social social-header">
                            @if(setting()->get('deputy_email', false))
                            <li>
                                <a class="link-blue" href="mailto:{{ setting()->get('deputy_email', false) }}">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </li>
                            @endif
                            @if(setting()->get('deputy_email', false))
                            <li>
                                <a class="link-blue" href="tel:{{ setting()->get('deputy_phone', false) }}">
                                    <i class="fas fa-phone"></i>
                                </a>
                            </li>
                            @endif
                        </ul>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>

    <section class="grow-business mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6" id="archetypeParent">
                    <h4 class="h-border">{{ __('Introduction') }}</h4>
                    <div class="abt-para">

                    <p>

                        {{ __('frontend.introduction_first_para') }}

                        <br>{{ __('frontend.introduction_second_para') }}

                        <br>{{ __('frontend.introduction_third_para') }}

                    </p>

                    </div>

                    <a href="{{ route('frontend.pages.about') }}" class="btn btn-theme btn-active">{{ __('read more') }}</a>
                    <a href="{{ route('frontend.pages.contact') }}" class="btn btn-theme">{{ __('Contact us') }}</a>
                </div>
                <div id="commodityPricesDailyTable" class="col-md-6" style="flex: 1;">
                    <div class="row" style="margin:0">
                        <div class="col-sm-12">
                            <div class="features-inner even bg-white">
                                <h5 style="padding-top:0;color:#006400">{{ __('Daily prices') }} - {{ $date }}
                                </h5>
                                <table id="commodityDailyPrice" class="dt table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Commodity') }}</th>
                                            <th>{{ __('Min') }}</th>
                                            <th>{{ __('Max') }}</th>
                                            <th>{{ __('Avg') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (App\Models\commodityPriceDaily::getPriceOptimized() as $index => $value)
                                            @php
                                                $currency = 'np' === __(app()->getLocale()) ? 'रू ' : 'Rs ';
                                            @endphp
                                            <tr>
                                                <td class="dt-body-left">{{ $value->commodityname }} <span class="text-muted">({{ $value->commodityunit }})</span></td>
                                                <td>{{ $currency . __i($value->minprice) }}</td>
                                                <td>{{ $currency . __i($value->maxprice) }}</td>
                                                <td>{{ $currency . __idf(($value->avgprice)) }}
                                                </td>
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
    </section>

    <div class="quote">
        <div class="container">
            <div class="row">
                <div class="col-sm-5">
                    <div class="get-q">
                        <a href="{{ asset('/apk/kalimati.apk') }}" class="btn btn-theme">{{ __('Download') }} <i class="fab fa-android" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="col-sm-7">
                    <p>{{ __('Get Commodity Prices On Your Phone') }}</p>
                </div>
            </div>
        </div>
    </div>


    <section class="service-01 sp-100">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="service-wrap current" data-tab="defi-tab-1"
                                style="background-image:url('{{ asset('img/defi-bg1') }}.jpg')">
                                <div class="service-icon">
                                    <i class="fa fa-line-chart"></i>
                                </div>
                                <h4>{{ __('General Notice') }}</h4>
                                <p>{{ __('Click here to check') }} {{ __('General Notice') }}
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="service-wrap" data-tab="defi-tab-2"
                                style="background-image:url('{{ asset('img/defi-bg2') }}.jpg')">
                                <div class="service-icon">
                                    <i class="fa fa-line-chart"></i>
                                </div>
                                <h4>{{ __('Tender Invitations') }}</h4>
                                <p>{{ __('Click here to check') }} {{ __('Tender Invitations') }}
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="service-wrap" data-tab="defi-tab-3"
                                style="background-image:url('{{ asset('img/defi-bg3') }}.jpg')">
                                <div class="service-icon">
                                    <i class="fa fa-line-chart"></i>
                                </div>
                                <h4>{{ __('Pesticides Report') }}</h4>
                                <p>{{ __('Click here to check') }} {{ __('Pesticides Report') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-sm-pull-3">
                    <div class="defi-panel">
                        <div class="panel-content current" id="defi-tab-1">
                            <div class="content-wrap">
                                <h2>{{ __('General Notice') }}</h2>
                                <div class="project-detail">
                                    <h4>{{ __('frontend_notice.notice_list_title', ['title' => __('General Report')]) }}</h4>
                                    <div class="pro-info">
                                        <div class="table-responsive">
                                            @php
                                                $tableRow = 1;
                                            @endphp
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('Title') }}</th>
                                                        <th>{{ __('Download') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach (\App\Models\Backend\Notices::where('type', 'notice')->orderBy('published_at', 'desc')->take(5)->get() as $noticeTuple)
                                                        <tr>
                                                            <td><a href="{{ route('frontend.pages.notice-show', $noticeTuple->id) }}">{!! strip_tags($noticeTuple->{'title_' . app()->getLocale()}) !!}</a></td>
                                                            <td><a href="{{ $noticeTuple->url  }}" download><i class="fa fa-download" aria-hidden="true"></i> {{ __('Download') }}</a></td>
                                                        </tr>
                                                        @php
                                                            ++$tableRow;
                                                        @endphp
                                                    @endforeach
                                                    @if(1 === $tableRow)
                                                    <tr>
                                                        <td colspan="2">{{__('frontend_notice.notice_no_results_found')}}</td>
                                                    </tr>
                                                    @endif
                                                    <tr>
                                                        <td colspan="2"><a href="{{ route('frontend.pages.notice', 'notice')  }}">{{__('View All')}}</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-content" id="defi-tab-2">
                            <div class="content-wrap">
                                <h2>{{ __('Tender Invitations') }}</h2>
                                <div class="project-detail">
                                    <h4>{{ __('frontend_notice.notice_list_title', ['title' => __('Tender Invitations')]) }}</h4>
                                    <div class="pro-info">
                                        <div class="table-responsive">
                                            @php
                                                $tableRow = 1;
                                            @endphp
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('Title') }}</th>
                                                        <th>{{ __('Download') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach (\App\Models\Backend\Notices::where('type', 'tender')->orderBy('published_at', 'desc')->take(5)->get() as $noticeTuple)
                                                        <tr>
                                                            <td><a href="{{ route('frontend.pages.notice-show', $noticeTuple->id) }}">{!! strip_tags($noticeTuple->{'title_' . app()->getLocale()}) !!}</a></td>
                                                            <td><a href="{{ $noticeTuple->url  }}" download><i class="fa fa-download" aria-hidden="true"></i> {{ __('Download') }}</a></td>
                                                        </tr>
                                                        @php
                                                            ++$tableRow;
                                                        @endphp
                                                    @endforeach
                                                    @if(1 === $tableRow)
                                                    <tr>
                                                        <td colspan="2">{{__('frontend_notice.notice_no_results_found')}}</td>
                                                    </tr>
                                                    @endif
                                                    <tr>
                                                        <td colspan="2"><a href="{{ route('frontend.pages.notice', 'tender')  }}">{{__('View All')}}</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-content" id="defi-tab-3">
                            <div class="content-wrap">
                                <h2> {{ __('Pesticides Report') }}</h2>
                                <div class="project-detail">
                                    <h4>{{ __('frontend_notice.notice_list_title', ['title' => __('Pesticides Report')]) }}</h4>
                                    <div class="pro-info">
                                        <div class="table-responsive">
                                            @php
                                                $tableRow = 1;
                                            @endphp
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('Title') }}</th>
                                                        <th>{{ __('Download') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach (\App\Models\Backend\Notices::where('type', 'pest')->orderBy('published_at', 'desc')->take(5)->get() as $noticeTuple)
                                                        <tr>
                                                            <td><a href="{{ route('frontend.pages.notice-show', $noticeTuple->id) }}">{!! strip_tags($noticeTuple->{'title_' . app()->getLocale()}) !!}</a></td>
                                                            <td><a href="{{ $noticeTuple->url  }}" download><i class="fa fa-download" aria-hidden="true"></i> {{ __('Download') }}</a></td>
                                                        </tr>
                                                        @php
                                                            ++$tableRow;
                                                        @endphp
                                                    @endforeach
                                                    @if(1 === $tableRow)
                                                    <tr>
                                                        <td colspan="2">{{__('frontend_notice.notice_no_results_found')}}</td>
                                                    </tr>
                                                    @endif
                                                    <tr>
                                                        <td colspan="2"><a href="{{ route('frontend.pages.notice', 'pest')  }}">{{__('View All')}}</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-content" id="defi-tab-4">
                            <div class="content-wrap">
                                <h2>{{ __('Bills Publication') }}</h2>
                                <div class="project-detail">
                                    <h4>{{ __('frontend_notice.notice_list_title', ['title' => __('Bills Publication')]) }}</h4>
                                    <div class="pro-info">
                                        <div class="table-responsive">
                                            @php
                                                $tableRow = 1;
                                            @endphp
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('Title') }}</th>
                                                        <th>{{ __('Download') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach (\App\Models\Backend\Notices::where('type', 'bill_publication')->orderBy('published_at', 'desc')->take(5)->get() as $noticeTuple)
                                                        <tr>
                                                            <td><a href="{{ route('frontend.pages.notice-show', $noticeTuple->id) }}">{!! strip_tags($noticeTuple->{'title_' . app()->getLocale()}) !!}</a></td>
                                                            <td><a href="{{ $noticeTuple->url  }}" download><i class="fa fa-download" aria-hidden="true"></i> {{ __('Download') }}</a></td>
                                                        </tr>
                                                        @php
                                                            ++$tableRow;
                                                        @endphp
                                                    @endforeach
                                                    @if(1 === $tableRow)
                                                    <tr>
                                                        <td colspan="2">{{__('frontend_notice.notice_no_results_found')}}</td>
                                                    </tr>
                                                    @endif
                                                    <tr>
                                                        <td colspan="2"><a href="{{ route('frontend.pages.notice', 'bill_publication')  }}">{{__('View All')}}</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-content" id="defi-tab-5">
                            <div class="content-wrap">
                                <h2>{{ __('Right To Information') }}</h2>
                                <div class="project-detail">
                                    <h4>{{ __('frontend_notice.notice_list_title', ['title' => __('Reports')]) }}</h4>
                                    <div class="pro-info">
                                        <div class="table-responsive">
                                            @php
                                                $tableRow = 1;
                                            @endphp
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('Title') }}</th>
                                                        <th>{{ __('Download') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach (\App\Models\Backend\Notices::where('type', 'annual')->orderBy('published_at', 'desc')->take(5)->get() as $noticeTuple)
                                                        <tr>
                                                            <td><a href="{{ route('frontend.pages.notice-show', $noticeTuple->id) }}">{!! strip_tags($noticeTuple->{'title_' . app()->getLocale()}) !!}</a></td>
                                                            <td><a href="{{ $noticeTuple->url  }}" download><i class="fa fa-download" aria-hidden="true"></i> {{ __('Download') }}</a></td>
                                                        </tr>
                                                        @php
                                                            ++$tableRow;
                                                        @endphp
                                                    @endforeach
                                                    @if(1 === $tableRow)
                                                    <tr>
                                                        <td colspan="2">{{__('frontend_notice.notice_no_results_found')}}</td>
                                                    </tr>
                                                    @endif
                                                    <tr>
                                                        <td colspan="2"><a href="{{ route('frontend.pages.notice', 'annual')  }}">{{__('View All')}}</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-content" id="defi-tab-6">
                            <div class="content-wrap">
                                <h2>{{ __('Literature Publication') }}</h2>
                                <div class="project-detail">
                                    <h4>{{ __('frontend_notice.notice_list_title', ['title' => __('Literature Publication')]) }}</h4>
                                    <div class="pro-info">
                                        <div class="table-responsive">
                                            @php
                                                $tableRow = 1;
                                            @endphp
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('Title') }}</th>
                                                        <th>{{ __('Download') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach (\App\Models\Backend\Notices::where('type', 'publication')->orderBy('published_at', 'desc')->take(5)->get() as $noticeTuple)
                                                        <tr>
                                                            <td><a href="{{ route('frontend.pages.notice-show', $noticeTuple->id) }}">{!! strip_tags($noticeTuple->{'title_' . app()->getLocale()}) !!}</a></td>
                                                            <td><a href="{{ $noticeTuple->url  }}" download><i class="fa fa-download" aria-hidden="true"></i> {{ __('Download') }}</a></td>
                                                        </tr>
                                                        @php
                                                            ++$tableRow;
                                                        @endphp
                                                    @endforeach
                                                    @if(1 === $tableRow)
                                                    <tr>
                                                        <td colspan="2">{{__('frontend_notice.notice_no_results_found')}}</td>
                                                    </tr>
                                                    @endif
                                                    <tr>
                                                        <td colspan="2"><a href="{{ route('frontend.pages.notice', 'publication')  }}">{{__('View All')}}</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-sm-push-6">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="service-wrap" data-tab="defi-tab-4"
                                style="background-image:url('{{ asset('img/defi-bg4') }}.jpg')">
                                <div class="service-icon">
                                    <i class="fa fa-line-chart"></i>
                                </div>
                                <h4>{{ __('Bills Publication') }}</h4>
                                <p>{{ __('Click here to check') }} {{ __('Bills Publication') }}
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="service-wrap" data-tab="defi-tab-5"
                                style="background-image:url('{{ asset('img/defi-bg5') }}.jpg')">
                                <div class="service-icon">
                                    <i class="fa fa-line-chart"></i>
                                </div>
                                <h4>{{ __('Right To Information') }}</h4>
                                <p>{{ __('Click here to check') }} {{ __('Reports') }}
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="service-wrap" data-tab="defi-tab-6"
                                style="background-image:url('{{ asset('img/defi-bg6') }}.jpg')">
                                <div class="service-icon">
                                    <i class="fa fa-line-chart"></i>
                                </div>
                                <h4>{{ __('Literature Publication') }}</h4>
                                <p>{{ __('Click here to check') }} {{ __('Literature Publication') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('footer')
    <div class="quote">
        <div class="container">
            <div class="row">
                <div class="col-sm-7">
                    <p>{{ __('Any complaints, feedback, or Insights?') }}</p>
                </div>
                <div class="col-sm-5">
                    <div class="get-q">
                        <a href="{{ route('frontend.pages.contact') }}" class="btn btn-theme">{{ __('Reach out to us') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1926.1552009763843!2d85.29838516661253!3d27.699245188889606!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb1859798f8e47%3A0x191ede6479b87d77!2sVegetables%2C%20fruits%20wholesale%20market%20business%20entity!5e0!3m2!1sen!2snp!4v1655088651242!5m2!1sen!2snp"
        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
@endpush

@include('includes.partials.notices_modal')
