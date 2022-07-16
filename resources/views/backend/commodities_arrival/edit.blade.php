@extends('backend.layouts.app')

@section('title', __('Update Commodity'))

@inject('user', '\App\Domains\Auth\Models\User')

@section('content')
    <x-forms.patch :action="route('admin.commodities-arrival.update', $data['id'])">
        <x-backend.card>
            <x-slot name="header">
                @lang('Update Commodity')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.commodities-arrival.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                    <div>{!! render_html($fields, $data) !!}</div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update Commodity')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection

@push('after-scripts')
    <script>
        ((function($) {

            const textareas = $('textarea');
            textareas.each(function() {
                // check if the textarea is disabled.
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
                    placeholder: $(this).attr('placeholder'),
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
