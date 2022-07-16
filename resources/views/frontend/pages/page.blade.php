@extends('frontend.template')

@section('title', __('About Us'))

@section('content')
<div class="blog blog-2 sp-70-100" style="padding-top:0">
    <article class="col-md-12">
        <div class="blog-item verti">
            <div class="blog-img vh-60">
                <img src="{{ $article->article_image }}" alt="{{ __(appName()) }}">
            </div>
            <div class="blog-content">
                <h4>
                    {{ $article->{'title_'. app()->getLocale()} }}
                </h4>
                <ul class="post-meta">
                    <li>
                        {{ __('Home') }}
                    </li>
                    <li>
                        <a href="{{ route('frontend.index') }}">{{ $article->{'title_'. app()->getLocale()} }}</a>
                    </li>
                </ul>
                {!! $article->{'content_'.app()->getLocale()} !!}
            </div>
        </div>
    </article>
</div>
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
