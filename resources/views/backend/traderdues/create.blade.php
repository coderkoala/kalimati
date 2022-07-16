@inject('model', '\App\Domains\Auth\Models\User')

@extends('backend.layouts.app')

@inject('user', '\App\Domains\Auth\Models\User')

@section('title', __('Create New Trader Due'))

@section('content')
    <x-forms.post :action="route('admin.traderdues.store')">
        <x-backend.card>
            <x-slot name="header">
                @lang('Create New Trader Due')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.traderdues.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div>{!! render_html($fields) !!}</div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Create New Trader Due')</button>
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
