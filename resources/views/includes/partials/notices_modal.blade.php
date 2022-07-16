@push('after-footer')
    @foreach ( $totalNotices = \App\Models\Backend\Notices::where('modal_view', 'true')->orderBy('published_at', 'desc')->get() as $index => $modalData)
        <div class="modal fade" id="notice{{ $index+1 }}" tabindex="-1" role="dialog" aria-labelledby="noticeLabel{{ $index+1 }}" aria-hidden="true" style="z-index: 10000">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="noticeLabel{{ $index+1 }}"> {{ $modalData->{'title_' . app()->getLocale()} }}</h4>
                        <button type="button" class="close btn-close-modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <p class="ml-3 mt-3">{{ __('Notices') }} {{ __idf($index+1, false) }} / {{ __idf($totalNotices->count(), false) }}</p>
                    <div class="modal-body">
                    <div class="row justify-content-between pl-3 pr-3">
                        {!! $modalData->{'content_' . app()->getLocale()} !!}
                    </div>

                    </div>
                    <div class="modal-footer">
                        <a href="{{ $modalData->url }}" download class="btn btn-outline-secondary">{{ __('Download') }}</a>
                        @if ( $index+1 === $totalNotices->count() )
                            <button type="button" class="btn btn-danger btn-close-modal">{{ __('Close') }}</button>
                        @else
                            <button type="button" class="btn btn-primary btn-next">{{ __('Next') }}</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endpush
