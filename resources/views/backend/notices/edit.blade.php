@extends('backend.layouts.app')

@section('title', __('Update Article'))

@inject('user', '\App\Domains\Auth\Models\User')

@section('content')
    <x-forms.patch :action="route('admin.notices.update', $data['id'])">
        <x-backend.card>
            <x-slot name="header">
                @lang('Update Notice/Publication')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.notices.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                    <div>{!! render_html($fields, $data) !!}</div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="url">{{ __('Article Image') }}</label>
                        <div class="col-md-10">
                            <div class="alert alert-warning" role="alert">{{ __('Allowed File Extensions: PDF, Excel, Word, JPG, PNG') }}</div>
                            <div class="input-group">
                                <span class="input-group-btn">
                                  <a
                                    id="file-manager-input"
                                    data-input="file"
                                    class="btn btn-primary text-white">
                                    <i class="cil-clipboard"></i>  {{ __('Choose File') }}
                                  </a>
                                </span>
                                <input id="file" class="form-control" type="text" name="url" value="{!! isset($data['url']) ? $data['url'] : '' !!}" readonly>
                            </div>
                        </div>
                    </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update Notice/Publication')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection

@include('backend.includes.partials.filemanager')

@push('after-scripts')
    <script>
        lfm('file-manager-input', 'file', {
            prefix: route_prefix,
            type: 'file'
        });
        jQuery('#file-manager-input').on('click', function(){
            jQuery('#holder').html('');
            jQuery('#file').val('').change();
        });
    </script>
@endpush

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
