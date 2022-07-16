<div class="marquee" style="width: 100%;overflow: hidden;color:black;background:white;line-height:1.5;font-size:17px;">
    @if (setting()->get('prices_marquee_' . app()->getLocale(), null))
        {!! setting()->get('prices_marquee_' . app()->getLocale()) !!}
    @else
        @foreach (App\Models\commodityPriceDaily::getPriceOptimized() as $key => $value)
            <strong>{{ $value->commodityname }} - {{ $value->commodityunit }}</strong> <span
                class="text-danger">⏷</span> {{ __idf($value->minprice) }} <span class="text-success">⏶</span>
            {{ __idf($value->maxprice) }} <span class="mr-3 ml-3">|</span>
        @endforeach
    @endif
</div>

@push('after-scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery.marquee@1.6.0/jquery.marquee.min.js" type="text/javascript"></script>
    <script>
        try {
            jQuery('.marquee').marquee({
                duration: {{ setting()->get('marquee_time', 12500) }}
            });
        } catch(e){}
    </script>
@endpush
