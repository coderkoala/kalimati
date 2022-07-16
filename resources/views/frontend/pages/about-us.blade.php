@extends('frontend.template')

@section('title', __('Overview'))

@section('content')
    <!--======  banner ====== -->
    <section class="banner" style="background-image:url(img/slide1.jpg);overflow:hidden;">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="banner-heading">
                        <h2>{{ __('Overview') }}</h2>
                    </div>
                    <div class="banner-link">
                        <ul>
                            <li>
                                <a href="/">{{ __('Home') }}</a>
                            </li>
                            <li>
                                <span class="active">{{ __('Overview') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="grow-business sp-100">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="all-title">
                        <div class="sec-title">
                            <h3>
                                <span>{{ __(appName()) }}</span>
                            </h3>
                        </div>
                        <p>
                            {{ __('Welcome to the biggest fruits and vegetables commodities market, that Nepal has to offer') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h4 class="h-border">{{ __('Regulating the market in Nepalese consumer interest since 1995') }}</h4>
                    <div class="abt-para">
                    <p>
                        {{ __('frontend.about_us_first_para') }}
                    </p>
                    <p>
                        {{ __('frontend.about_us_second_para') }}
                    </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="buz-video">
                        <img src="https://img.youtube.com/vi/GmWaVbyshp8/maxresdefault.jpg" alt="woman">
                        <a href="https://www.youtube.com/watch?v=GmWaVbyshp8" target="_blank" class="vid-btn"
                            data-lity="">
                            <i class="fa fa-play"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if( 'true' === setting()->get('show_message_from_director', 'true'))
        <section class="grow-business sp-100">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="all-title">
                            <div class="sec-title">
                                <h3>
                                    <span> {{ __('Message from the Executive Director') }}</span>
                                </h3>
                            </div>
                            <p>
                                {{ __('Regulating the market in Nepalese consumer interest since 1995') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="features-inner even feature-no-margin" style="min-height=3vh;">
                                    <img src="{{ setting()->get('executive_image', 'https://place-hold.it/400x400') }}"
                                        alt="member">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h4 class="h-border">
                            {{ __("It gives me immense pleasure to welcome you to Kalimati Fruits and Vegetables Market's cause") }}
                        </h4>
                        <div class="abt-para">
                            <p>
                                {{ __('frontend.about_us_third_para') }}
                            </p>
                            <p>
                                {{ __('frontend.about_us_fourth_para') }}
                            </p>

                            <h5>{{__("board_members.executive_director")}}</h5>
                            <p>{{ __('Executive Director') }}</p>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if( 'true' === setting()->get('show_our_history', 'true'))
        <section class="our-history sp-100">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="all-title">
                            <div class="sec-title">
                                <h3>
                                    <span>{{ __('Our history') }}</span>
                                </h3>
                            </div>
                            <p>
                                {{ __('Learn about Kalimati Vegetable and Fruits Market\'s rich history in Nepal') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="ver-timeline">
                    <div class="timeline-block">
                        <div class="timeline-icon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <div class="timeline-content">
                            <div class="t-date">
                                <h3>
                                    {{ __('15 Aswin') }},
                                    <span>{{ __('2043 BS') }}</span>
                                </h3>
                            </div>
                            <div class="t-parag">
                                <h4>{{ __('Establishment of the Market') }}</h4>
                                <p>
                                    {{ __('The market was established in 15 Aswin 2043 BS by the Food and Agricultural Market Service Department') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="timeline-block">
                        <div class="timeline-icon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <div class="timeline-content">
                            <div class="t-date">
                                <h3>
                                    {{ __('2045-2050 BS') }}
                                </h3>
                            </div>
                            <div class="t-parag">
                                <h4>{{ __('Expansion of Market') }}</h4>
                                <p>
                                    {{ __('Due to increase in demand, the infrastructure of the market was upgraded by Nepal government and UNCDF') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="timeline-block">
                        <div class="timeline-icon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <div class="timeline-content">
                            <div class="t-date">
                                <h3>
                                    {{ __('2051 BS') }}
                                </h3>
                            </div>
                            <div class="t-parag">
                                <h4>{{ 'Introduction of Kalimati Market Bill' }}</h4>
                                <p>
                                    {{ __('A Bill was passed to regulate the market, under Ministry of Agriculture and Livestock Development\'s bequest') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="timeline-block">
                        <div class="timeline-icon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <div class="timeline-content">
                            <div class="t-date">
                                <h3>
                                    {{ __('2058 BS') }}
                                </h3>
                            </div>
                            <div class="t-parag">
                                <h4>{{ __('Bill Ammendment') }}</h4>
                                <p>
                                    {{ __('In 2058 BS, the bill was amended to regulate the market under Federal Government') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
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
                        <a href="{{ route('frontend.pages.contact') }}"
                            class="btn btn-theme">{{ __('Reach out to us') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1926.1552009763843!2d85.29838516661253!3d27.699245188889606!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb1859798f8e47%3A0x191ede6479b87d77!2sVegetables%2C%20fruits%20wholesale%20market%20business%20entity!5e0!3m2!1sen!2snp!4v1655088651242!5m2!1sen!2snp"
        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
@endpush
