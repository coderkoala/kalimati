<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ __('Kalimati Fruits and Vegetable Market Development Board') . ' : ' . __('Regulating the market in Nepalese consumer interest since 1995') }}</title>
        <meta name="description" content="{{__('Regulating the market in Nepalese consumer interest since 1995')}}">
        <meta name="author" content="@yield('meta_author', 'Nobel Dahal')">
        @yield('meta')

        @stack('before-styles')
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="{{ mix('css/frontend.css') }}" rel="stylesheet">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

			[x-cloak] {
				display: none;
			}

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
        @stack('after-styles')

        @include('includes.partials.ga')
    </head>
    <body id="demo-swicher">
		<!-- ====== scroll to top ====== -->
		<a id="oscornScroll" title="Go to top" href="javascript:void(0)" class="scrolltotop">
			<i class="fa fa-angle-up"></i>
		</a>

		<div id="preloader"></div>

		<header class="web__navbar">
			<div class="ui container d-none d-lg-block">
				<div class="navbar__top"><a class="navbar-brand" href="/"><img src="images/gov_insignia.svg" alt="MOAD" class="ui small image"></a>
					<div class="site__meta">
						<span>{!! __('Government of Nepal<br>Ministry of Agriculture and Livestock Development') !!}</span>
						<h1>{{ __('Kalimati Fruits and Vegetable Market Development Board') }}</h1>
					</div>

					<div class="navbar__right">
						<div style="display: flex; height: 73px; align-items: center;"><img src="img/logo.png" alt="Nepal Flag" class="ui image flag"></div>
					</div>
				</div>
			</div>

			<div class="theme-mobile-menu d-lg-none top-head">
				<div class="mobile-logo">
					<a href="{{route('frontend.index')}}">
						<img src="img/logo.png" style="height:60px" alt="{{__('Kalimati Fruits and Vegetable Market Development Board')}}"> <strong style="color:white;">{{ __('Kalimati Market Development Board') }}</strong>
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
								<li class="menu-item">
									<a href="#archetypeParent" class="menu-link">{{ __('About us') }}</a>
								</li>
								<li class="menu-item">
									<a href="{{route('frontend.dues')}}" class="menu-link">{{ __('Trader Dues') }}</a>
								</li>
								<li class="menu-item">
									<a href="#contact" class="menu-link">{{ __('Contact us') }}</a>
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

								@if(config('boilerplate.locale.status') && count(config('boilerplate.locale.languages')) > 1)
								<li class="menu-item has-sub">
									<a href="javascript:void(0)" class="menu-link">{{ __(getLocaleName(app()->getLocale())) }}</a>
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
			<!-- include('frontend.includes.nav') -->
			@include('includes.partials.messages')

			<main>
				@yield('content')
			</main>
		</div><!--app-->

		<!-- ====== footer ====== -->
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
											<i class="fa fa-phone" style="top: 20%;position: relative;"></i>
											<a href="tel:+9775123086">{{__('5123086')}}</a>
										</li>
										<li>
											<i class="fa fa-envelope"></i>
											<p>kalimatimarket@gmail.com </p>
										</li>
										<li>
											<i class="fa fa-globe"></i>
											<p>www.kalimatimarket.gov.np</p>
										</li>
										<li>
											<i class="fa fa-phone-square"></i>
											<p>{{__('Notice Board Number')}}: {{ __('16180 707 66666')}}</p>
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
							<h3>{{__('Find us')}}</h3>
							<div class="soc-links">
								<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14130.299391376013!2d85.3000801!3d27.6995323!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xc11005272af8e800!2sKalimati%20Fruits%20%26%20Vegetable%20Market%20Development%20Board!5e0!3m2!1sen!2snp!4v1609659067464!5m2!1sen!2snp" width="250" height="auto" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
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
						{{__("© 2021")}} {{__('All Rights Reserved')}} | <a href="https://comptech.com.np" _target="blank">{{__('Powered by Comptech International Pvt. Ltd.')}}</a>
					</p>
				</div>
			</div>
		</section>

        @stack('before-scripts')
        <script src="{{ mix('js/manifest.js') }}"></script>
        <script src="{{ mix('js/vendor.js') }}"></script>
        <script src="{{ mix('js/frontend.js') }}"></script>
        @stack('after-scripts')
    </body>
</html>
