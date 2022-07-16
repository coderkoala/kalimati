@extends('backend.layouts.app')

@section('title', __('Update Article'))

@inject('user', '\App\Domains\Auth\Models\User')

@section('content')
    <x-forms.patch :action="route('admin.articles.update', $data['id'])">
        <x-backend.card>
            <x-slot name="header">
                @lang('Update Article')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.articles.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                    <div>{!! render_html($fields, $data) !!}</div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label" for="article_image">{{ __('Article Image') }}</label>
                        <div class="col-md-10">
                            <div class="alert alert-warning" role="alert">{{ __('If no image is selected, the system will select one for you; Valid image types that are allowed by the system: PNG, JPEG') }}</div>
                            <div class="input-group">
                                <span class="input-group-btn">
                                  <a
                                    id="file-manager-input"
                                    data-input="file"
                                    data-preview="holder"
                                    class="btn btn-primary text-white">
                                    <i class="cil-clipboard"></i>  {{ __('Choose File') }}
                                  </a>
                                </span>
                                <input id="file" class="form-control" type="text" name="article_image" value="{{ $values['article_image'] ?? asset('img/slide1.jpg') }}" readonly>
                            </div>
                            <div id="holder" style="margin-top:15px;max-height:100px;">
                                @if( isset($values['article_image']))
                                    <img style="height: 5rem" src="{{ $values['article_image'] ?? asset('img/slide1.jpg') }}">
                                @endif
                            </div>
                        </div>
                    </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update Article')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection

@include('backend.includes.partials.filemanager')

@push('after-scripts')
    <script>
        lfm('file-manager-input', 'image', {
            prefix: route_prefix,
            type: 'image'
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
