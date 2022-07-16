@extends('frontend.template')
@section('content')
    <input style="display:none;" id="i18n" value="{{ __(app()->getLocale()) }}" />

    <!--======  banner ====== -->
    <section class="banner" style="background-image:url({{ asset('img/slide3.jpg') }});overflow:hidden;">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="banner-heading">
                        <h2>{{ $notice_instance->{'title_' . app()->getLocale()} }}</h2>
                    </div>
                    <div class="banner-link">
                        <ul>
                            <li>
                                <a href="/">{{ __('Home') }}</a> >
                            </li>
                            <li>
                                <span>{{ $notice_title }}</span> >
                            </li>
                            <li>
                                <span class="active">{{ $notice_instance->{'title_' . app()->getLocale()} }}</span>
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
                        <h4>{{ $notice_instance->{'title_' . app()->getLocale()} }}</h4>
                        <div class="blog-detail-content">
                            <ul class="post-detail-meta" style="border-top:none;">
                                <li>
                                    <i class="fa fa-calendar"></i>
                                    <span>{{ ($date) }}</span>

                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-user"></i>{{ __('Kalimati Fruits and Vegetable Market Development Board') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="para mt-3 mb-3">
                <div class="d-flex text-justify">
                    {!! $notice_instance->{'content_' . app()->getLocale()} !!}
                </div>
                <hr>
                <strong>{{ __('Save Notice') }}</strong> : <a href="{!! $notice_instance->url !!}" download><i class="fa fa-download" aria-hidden="true"></i> {{ __('Download Notice') }}</a>
            </div>
            <div class="blog-detail mb-3">
                <h4>{{ __('Other Related Notices') }}</h4>
            </div>
            <div class="col-md-12">
                <div class="project-detail">
                    <h4>{{ __('frontend_notice.notice_list_title', ['title' => $notice_title]) }}</h4>
                    <div class="pro-info">
                        <div class="table-responsive">
                            @php
                                $tableRow = 1;
                            @endphp
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>{{ __('Title') }}</th>
                                        <th>{{ __('Content') }}</th>
                                        <th>{{ __('Published On') }}</th>
                                        <th>{{ __('Download') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notice as $noticeTuple)
                                        <tr>
                                            <td>{{ __idf($tableRow++, false) }}</td>
                                            <td>{!! strip_tags($noticeTuple->{'title_' . app()->getLocale()}) !!}</td>
                                            <td><a
                                                href="{{ route('frontend.pages.notice-show', $noticeTuple->id) }}">{{ __('View Notice') }}</a>
                                            </td>
                                            <td>{{ __idf($noticeTuple->published_at, false) }}</td>
                                            <td><a href="{!! $noticeTuple->url !!}" download><i class="fa fa-download"
                                                        aria-hidden="true"></i> {{ __('Download') }}</a></td>
                                        </tr>
                                    @endforeach
                                    @if (1 === $tableRow)
                                        <tr>
                                            <td colspan="5">
                                                {{__('frontend_notice.notice_no_results_found')}}</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
