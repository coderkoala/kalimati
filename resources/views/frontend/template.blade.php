<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ __('Kalimati Fruits and Vegetable Market Development Board') . ' : ' . __('Regulating the market in Nepalese consumer interest since 1995') }}</title>
        <meta name="description" content="{{__('Regulating the market in Nepalese consumer interest since 1995')}}">
        <meta name="author" content="@yield('meta_author', 'Nobel Dahal(@coderkoala)')">
        <link href="{{ mix('css/frontend.css') }}" rel="stylesheet">

        @yield('meta')
        @include('includes.partials.ga')
        @stack('before-styles')
        @stack('after-styles')
    </head>

    <body>
		<a id="scrollToTop" title="Go to top" href="javascript:void(0)" class="scrollToTop">
			<i class="fa fa-angle-up"></i>
		</a>

		<div id="preloader"></div>

		<header class="web__navbar">
			<div class="ui container d-none d-lg-block">
				<div class="navbar__top"><a class="navbar-brand" href="/"><img src="{{ asset('images/gov_insignia.svg') }}" alt="MOAD" class="ui small image"></a>
					<div class="site__meta">
						<span>{!! __('Government of Nepal<br>Ministry of Agriculture and Livestock Development') !!}</span>
						<h1>{{ __('Kalimati Fruits and Vegetable Market Development Board') }}</h1>
					</div>

					<div class="navbar__right">
						<div style="display: flex; height: 73px; align-items: center;"><img src="{{ asset('img/logo.png') }}" alt="Nepal Flag" class="ui image flag"></div>
					</div>
				</div>
			</div>

			<div class="theme-mobile-menu d-lg-none top-head">
				<div class="mobile-logo">
					<a href="{{route('frontend.index')}}">
						<img src="{{ asset('img/logo.png') }}" style="height:60px" alt="{{__('Kalimati Fruits and Vegetable Market Development Board')}}"> <strong style="color:white;">{{ __('Kalimati Market Development Board') }}</strong>
					</a>
				</div>

				<div class="menu-toggle hamburger-menu">
					<div class="top-bun"></div>
					<div class="meat"></div>
					<div class="bottom-bun"></div>
				</div>
				<div id="mobile-m" class="mobile-menu">
					<span class="close-menu">
						<i class="fa fa-times"></i>
					</span>
				</div>
			</div>

			<div class="bottom-head d-none d-lg-block">
				<div class="container clearfix">
					<div class="theme-menu">
						<nav class="menubar">
							<ul class="menu-wrap clearfix">
								<li class="menu-item">
									<a href="{{route('frontend.index')}}" class="menu-link">{{ __('Home') }}</a>
								</li>
                                <li class="menu-item has-sub">
                                    <a href="javascript:void(0)" class="menu-link">{{ __('About us') }}</a>
                                    <ul class="dropdown">
                                        <li class="dropdown-item">
                                            <a href="{{ route('frontend.pages.about') }}" class="menu-link">{{ __('Overview') }}</a>
                                        </li>
                                        @foreach(setting()->get('DATA_MENU', []) as $menuTuple)
                                            <li class="dropdown-item">
                                                <a href="{{ route('frontend.pages', $menuTuple['slug']) }}" class="menu-link">{{ $menuTuple['title_'. app()->getLocale()] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="menu-item has-sub">
                                    <a href="javascript:void(0)" class="menu-link">{{ __('Market Info') }}</a>
                                    <ul class="dropdown">
                                        <li class="dropdown-item">
                                            <a href="{{route('frontend.price')}}" class="menu-link">{{ __('Daily Price') }}</a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a href="{{route('frontend.daily-arrivals')}}" class="menu-link">{{ __('Daily Arrival') }}</a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a href="{{route('frontend.price-history')}}" class="menu-link">{{ __('Periodic Price') }}</a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a href="{{route('frontend.arrival-history')}}" class="menu-link">{{ __('Periodic Arrival') }}</a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a href="{{route('frontend.comparative-prices')}}" class="menu-link">{{ __('Comparative Price') }}</a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a href="{{route('frontend.arrival-comparision')}}" class="menu-link">{{ __('Comparative Arrival') }}</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item has-sub">
                                    <a href="javascript:void(0)" class="menu-link">{{ __('Trader Info') }}</a>
                                    <ul class="dropdown">
                                        <li class="dropdown-item">
                                            <a href="{{route('frontend.dues')}}" class="menu-link">{{ __('Trader Dues') }}</a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a href="{{route('frontend.pages.notice', 'traders')}}" class="menu-link">{{ __('Notice for Traders') }}</a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a id="traderDB" href="#" class="menu-link">{{ __('Trader Database') }}</a>
                                            <script defer>
                                                document.getElementById('traderDB').addEventListener('click', function(){
                                                    Swal.fire({
                                                        icon:'info',
                                                        title:'{{ __('Data not available') }}',
                                                        html:'{{ __('Trader data has not been made available yet, please try again later') }}',
                                                        confirmButtonText: '{{ __('OK') }}'
                                                    });
                                                });
                                            </script>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item has-sub">
                                    <a href="javascript:void(0)" class="menu-link">{{ __('Information') }}</a>
                                    <ul class="dropdown">
                                        <li class="dropdown-item">
                                            <a href="{{ route('frontend.pages.notice', 'notice') }}">{{ __('Notices') }}</a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a href="{{ route('frontend.pages.notice', 'tender') }}">{{ __('Tender Invitations') }}</a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a href="{{ route('frontend.pages.notice', 'bill_publication') }}">{{ __('Publicized Bills') }}</a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a href="{{ route('frontend.pages.notice', 'annual') }}">{{ __('General Reports') }}</a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a href="{{ route('frontend.pages.notice', 'pest') }}">{{ __('Pesticides Report') }}</a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a href="{{ route('frontend.pages.notice', 'publication') }}">{{ __('Publications') }}</a>
                                        </li>
                                    </ul>
                                </li>
								@guest

								@else
								@if ( in_array( Route::currentRouteName() , array('frontend.index'), true ) )
								<li class="menu-item has-sub">
									<a href="javascript:void(0)" class="menu-link">{{ $logged_in_user->name }}</a>
									<ul class="dropdown">
										@if ($logged_in_user->isAdmin())
										<li class="dropdown-item">
											<a href="{{ route('admin.dashboard') }}">{{ __('Administration') }}</a>
										</li>
										@endif
										@if ($logged_in_user->isUser())
										<li class="dropdown-item">
											<a href="{{ route('frontend.user.dashboard') }}">{{ __('Dashboard') }}</a>
										</li>
										@endif
										<li class="dropdown-item">
											<a href="{{ route('frontend.user.account') }}">{{ __('My Account') }}</a>
										</li>
										<li class="dropdown-item">
											<a href="#" onclick="event.preventDefault();document.getElementById('logout_method_btn').submit();">{{ __('Logout') }}</a>
											<form id="logout_method_btn" action="{{ route('frontend.auth.logout') }}" method="POST" class="d-none">
												@csrf
											</form>
										</li>
									</ul>
								</li>
								@endif
								@endguest

                                <li class="menu-item">
                                    <a href="{{ route('frontend.pages.contact') }}" class="menu-link">{{ __('Contact') }}</a>
                                </li>

								@if(config('boilerplate.locale.status') && count(config('boilerplate.locale.languages')) > 1)
								<li class="menu-item has-sub">
									<a href="javascript:void(0)" class="menu-link"><img src="{{ asset("img/" . app()->getLocale() . ".svg") }}" width="15" height="15"/></a>
									<ul class="dropdown">
										@include('includes.partials.lang')
									</ul>
								</li>
								@endif
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</header>

		@include('includes.partials.read-only')
		@include('includes.partials.logged-in-as')
		@include('includes.partials.announcements')

		<div id="app">
			@include('includes.partials.messages')
			@include('includes.partials.prices')
			<main>
				@yield('content')
			</main>
		</div>

        @stack('footer')

		<section class="footer">
			<div class="container">
				<div class="footer-top">
					<div class="row">
						<div class="col-md-4 mb-60">
							<div class="company-details">
								<h2>
								{{ __('Kalimati Fruits and Vegetable Market Development Board') }}
								</h2>
								<div class="f-content">
									<p>{{ __('Ganeshman Singh Road, Kathmandu 44600')}}</p>
									<ul>
										<li>
											<i class="fa fa-phone"></i>
											<p>{{ __('Office Phone') }} : <a href="tel:+9775123086">{{__idf('5123086', false)}}</a>
										</li>
                                        <li>
											<i class="fa fa-phone"></i>
											<p>{{ __('Notice Board') }} : <a href="tel:+1618070766666">{{__idf('1618070766666', false)}}</a></p>
										</li>
										<li>
											<i class="fa fa-envelope"></i>
											<p>kalimatimarket@gmail.com</p>
										</li>
										<li>
											<i class="fa fa-globe"></i>
											<p>www.kalimatimarket.gov.np</p>
										</li>
									</ul>
								</div>
								<ul class="social">
									<li>
										<a href="https://www.facebook.com/kalimativegetablesmarket/" target="_blank">
											<i class="fab fa-facebook-f"></i>
										</a>
									</li>
								</ul>
							</div>
						</div>

						<div class="col-md-4 mb-60">
							<div class="company-details">
								<h2>
								{{ __('Quick Links') }}
								</h2>
								<div class="f-content">
									<ul>
										<li><p><i class="fa fa-globe"></i><a href="/">{{ __('Home') }}</a></p></li>
										<li><p><i class="fa fa-globe"></i><a href="{{ route('frontend.pages.contact') }}">{{ __('Contact us') }}</a></p></li>
										<li><p><i class="fa fa-globe"></i><a href="{{ setting()->get('url_citizen_charter', '#') }}">{{ __('Citizen Charter') }}</a></p></li>
										<li><p><i class="fa fa-globe"></i><a href="{{ route('frontend.pages.notice', 'notice') }}">{{ __('Notices') }}</a></p></li>
										<li><p><i class="fa fa-globe"></i><a href="{{ setting()->get('url_organization_structure', '#') }}">{{ __('Organization Structure') }}</a></p></li>
										<li><p><i class="fa fa-globe"></i><a href="{{ route('frontend.pages.notice', 'pest') }}">{{ __('Pesticides Report') }}</a></p></li>
										<li><p><i class="fa fa-globe"></i><a href="{{ route('frontend.pages.notice', 'bill_publication') }}">{{ __('Public Billing Report') }}</a></p></li>
										<li><p><i class="fa fa-globe"></i><a href="{{ route('frontend.pages.notice', 'tender') }}">{{ __('Tenders') }}</a></p></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-md-4 mb-60">
							<h3>{{__('subscribe to newsletter')}}</h3>
							<form action="#" class="footer-form">
								<input type="email" name="email" id="email" placeholder="{{__('Enter Your Email')}}" class="form-control">
								<button type="submit" class="btn btn-theme">{{__('subscribe now')}}</button>
							</form>
						</div>
					</div>
				</div>
				<div class="footer-bottom">
					<p>
						{{__("© " . __idf(date('Y'), false))}} {{__('All Rights Reserved')}} | <a href="https://comptech.com.np" _target="blank">{{__(appName())}}</a>
					</p>
				</div>
			</div>
		</section>

        @stack('after-footer')

        @stack('before-scripts')
        <script src="{{ mix('js/manifest.js') }}"></script>
        <script src="{{ mix('js/vendor.js') }}"></script>
        <script src="{{ mix('js/frontend.js') }}"></script>
        <script src="{{ asset('/vendor/dt/datatables.js') }}"></script>
        @stack('after-scripts')
    </body>
</html>
