@extends('frontend.template')

@section('title', __('Login'))

@section('content')
    <div class="container py-4" style="margin-bottom:3rem;">
        <div class="row justify-content-center">
            <div class="col-md-8">
			<div class="project-detail">
						<h4>{{ __('Login') }}</h4>
						<div class="pro-info" style="padding:3rem;">
						<x-forms.post :action="route('frontend.auth.login')" class="footer-form">
							<div class="form-group row" style="margin-bottom:1rem;">
								<label for="email" class="col-md-4 col-form-label text-md-right">@lang('E-mail Address')</label>
								<div class="col-md-6">
									<input type="email" style="padding:.375rem .75rem;" name="email" id="email" class="form-control" placeholder="{{ __('E-mail Address') }}" value="{{ old('email') }}" maxlength="255" required autofocus autocomplete="email" />
								</div>
							</div>

							<div class="form-group row" style="margin:1rem;">
								<label for="password" class="col-md-4 col-form-label text-md-right">@lang('Password')</label>
								<div class="col-md-6">
									<input type="password" style="padding:.375rem .75rem;" name="password" id="password" class="form-control" placeholder="{{ __('Password') }}" maxlength="100" required autocomplete="current-password" />
								</div>
							</div>

							<div class="form-group row" style="margin:1rem;">
								<div class="col-md-6 offset-md-4">
									<div class="form-check">
										<input name="remember" id="remember" class="form-check-input" type="checkbox" {{ old('remember') ? 'checked' : '' }} />
										<label class="form-check-label" for="remember">
											@lang('Remember Me')
										</label>
									</div>
								</div>
							</div>

							@if(config('boilerplate.access.captcha.login'))
								<div class="row">
									<div class="col">
										@captcha
										<input type="hidden" name="captcha_status" value="true" />
									</div><!--col-->
								</div><!--row-->
							@endif

							<div class="form-group row mb-0">
								<div class="col-md-8 offset-md-4">
									<button class="btn contact-us top-head btn-theme" style="width:50%" type="submit">@lang('Login')</button>

									<x-utils.link :href="route('frontend.auth.password.request')" class="btn btn-link" style="color:#ff0000;" :text="__('Forgot Your Password?')" />
								</div>
							</div>

							<div class="text-center">
								@include('frontend.auth.includes.social')
							</div>
						</x-forms.post>
					</div>
				</div>
            </div><!--col-md-8-->
        </div><!--row-->
    </div><!--container-->
@endsection
