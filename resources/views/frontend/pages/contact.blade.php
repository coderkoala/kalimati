@extends('frontend.template')

@section('title', __('Contact Us'))

@section('content')
    <!--======  banner ====== -->
    <section class="banner" style="background-image:url(img/slide1.jpg);overflow:hidden;">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="banner-heading">
                        <h2>{{ __('Contact Us') }}</h2>
                    </div>
                    <div class="banner-link">
                        <ul>
                            <li>
                                <a href="/">{{ __('Home') }}</a>
                            </li>
                            <li>
                                <span class="active">{{ __('Contact Us') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-us sp-100">
        <div class="container">
            <div class="residenc">
                <div class="row center-grid">
                    <div class="col-md-12 col-sm-12">
                        <h4>{{ __('Head Offices') }}</h4>
                        <div class="addres">
                            <img src="{{ asset('/img/np.svg') }}" width="70" height="70" alt="{{ __('Nepal\'s Flag') }}">
                            <p>
                                {{ __('Ganeshman Singh Road, Kathmandu 44600')}},<br>
                                {{ __('Notice Board') }} : <a href="tel:+1618070766666">{{__idf('1618070766666', false)}}</a>,</br>
                                {{ __('Office Phone') }} : <a href="tel:+9775123086">{{__idf('5123086', false)}}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <form action="#">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" placeholder="{{ __('Full Name') }}" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <input type="Email" placeholder="{{ __('Email Address') }}" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <input type="text" placeholder="{{ __('Phone no.') }}" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <div class="sel-wrap">
                            <select class="form-control custom-select" id="service">
                                <option selected='selected' disabled>{{ __('Nature of help needed') }}</option>
                                <option>{{ __('General Query') }}</option>
                                <option>{{ __('Administration related') }}</option>
                                <option>{{ __('Suggestion') }}</option>
                                <option>{{ __('Support') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <textarea name="massage" class="form-control" id="message" placeholder="{{ __('Your Query') }}" rows="10"></textarea>
                    </div>
                    <div class="col-md-12 clearfix">
                        <a href="#" class="btn btn-theme send">{{ __('submit') }}</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('footer')
    <iframe
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1926.1552009763843!2d85.29838516661253!3d27.699245188889606!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb1859798f8e47%3A0x191ede6479b87d77!2sVegetables%2C%20fruits%20wholesale%20market%20business%20entity!5e0!3m2!1sen!2snp!4v1655088651242!5m2!1sen!2snp"
    width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

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
@endpush
