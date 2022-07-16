@inject('model', '\App\Domains\Auth\Models\User')

@extends('backend.layouts.app')

@section('title', __('Marquee Content Setting'))

@section('content')
    <x-forms.post :action="route('admin.setting')">
        <x-backend.card>
            <x-slot name="header">
                @lang('Marquee Content Setting')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.dashboard')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">{{ __('Website Marquee(EN)') }}</label>
                    <div class="col-md-10">
                        <textarea required name="prices_marquee_en" id="prices_marquee_en" cols="30" rows="10">{!! setting()->get('prices_marquee_en', null) !!}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">{{ __('Website Marquee(NP)') }}</label>
                    <div class="col-md-10">
                        <textarea required name="prices_marquee_np" id="prices_marquee_np" cols="30" rows="10">{!! setting()->get('prices_marquee_np', null) !!}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">{{ __('Duration (in ms)') }}</label>
                    <div class="col-md-10">
                        <input class="form-control" type="number" name="marquee_time" id="marquee_time" value="{{ setting()->get('marquee_time', 12500) }}">
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update Settings')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection

@push('after-scripts')
    <script>
        ((function($) {
            const textareas = $('textarea');
            textareas.each(function() {
                if ($(this).prop('disabled')) {
                    return;
                }
                SUNEDITOR.create($(this).attr('id'), {
                    display: 'block',
                    width: '100%',
                    height: 'auto',
                    popupDisplay: 'full',
                    charCounter: true,
                    charCounterLabel: '{{ __('Characters') }} :',
                    buttonList: [
                        ['redo', 'undo', 'save'],
                        ['fontSize', 'formatBlock'],
                        ['paragraphStyle', 'blockquote'],
                        ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript'],
                        ['removeFormat'],
                        ['align', 'horizontalRule', 'list', 'lineHeight'],
                        ['table', 'link', 'image'],
                        ['showBlocks', 'codeView'],
                    ],
                    templates: [{
                            name: 'Template-1',
                            html: '<p>HTML source1</p>'
                        },
                        {
                            name: 'Template-2',
                            html: '<p>HTML source2</p>'
                        }
                    ],
                });
            });

        }))(jQuery);
    </script>
@endpush
