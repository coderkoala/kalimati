@inject('model', '\App\Domains\Auth\Models\User')

@extends('backend.layouts.app')

@section('title', __('Board Member Information Settings'))

@section('content')
    <x-forms.post :action="route('admin.setting')">
        <x-backend.card>
            <x-slot name="header">
                @lang('Board Member Information Settings')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.dashboard')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="article_image">{{ __('Chairperson') }}</label>
                    <div class="col-md-10">
                        <div class="input-group flex-nowrap mb-2">
                            <span class="input-group-text" id="addon-wrapping">{{ 'E-mail' }}</span>
                            <input name="chairperson_email" type="text" class="form-control" aria-describedby="addon-wrapping" value="{{ setting()->get('chairperson_email') }}">
                        </div>
                        <div class="input-group flex-nowrap mb-2">
                            <span class="input-group-text" id="addon-wrapping">{{ 'Phone' }}</span>
                            <input name="chairperson_phone" type="text" class="form-control" aria-describedby="addon-wrapping" value="{{ setting()->get('chairperson_phone') }}">
                        </div>
                        <div class="input-group">
                            <span class="input-group-btn">
                              <a
                                id="chairperson_image_anchor"
                                data-input="chairperson_image"
                                data-preview="chairperson_holder"
                                class="btn btn-primary text-white">
                                <i class="cil-clipboard"></i>  {{ __('Choose File') }}
                              </a>
                            </span>
                            <input id="chairperson_image" class="form-control" type="text" name="chairperson_image" value="{{ setting()->get('chairperson_image','https://place-hold.it/400x400') }}" readonly>
                        </div>
                        <div id="chairperson_holder" style="margin-top:15px;max-height:100px;">
                        <img style="height: 5rem" src="{{ setting()->get('chairperson_image','https://place-hold.it/400x400') }}">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="article_image">{{ __('Executive Director') }}</label>
                    <div class="col-md-10">
                        <div class="input-group flex-nowrap mb-2">
                            <span class="input-group-text" id="addon-wrapping">{{ 'E-mail' }}</span>
                            <input name="executive_email" type="text" class="form-control" aria-describedby="addon-wrapping" value="{{ setting()->get('executive_email') }}">
                        </div>
                        <div class="input-group flex-nowrap mb-2">
                            <span class="input-group-text" id="addon-wrapping">{{ 'Phone' }}</span>
                            <input name="executive_phone" type="text" class="form-control" aria-describedby="addon-wrapping" value="{{ setting()->get('executive_phone') }}">
                        </div>
                        <div class="input-group">
                            <span class="input-group-btn">
                              <a
                                id="executive_image_anchor"
                                data-input="executive_image"
                                data-preview="executive_holder"
                                class="btn btn-primary text-white">
                                <i class="cil-clipboard"></i>  {{ __('Choose File') }}
                              </a>
                            </span>
                            <input id="executive_image" class="form-control" type="text" name="executive_image" value="{{ setting()->get('executive_image', 'https://place-hold.it/400x400') }}" readonly>
                        </div>
                        <div id="executive_holder" style="margin-top:15px;max-height:100px;">
                        <img style="height: 5rem" src="{{ setting()->get('executive_image', 'https://place-hold.it/400x400') }}">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label" for="article_image">{{ __('Information Officer') }}</label>
                    <div class="col-md-10">
                        <div class="input-group flex-nowrap mb-2">
                            <span class="input-group-text" id="addon-wrapping">{{ 'E-mail' }}</span>
                            <input name="deputy_email" type="text" class="form-control" aria-describedby="addon-wrapping" value="{{ setting()->get('deputy_email') }}">
                        </div>
                        <div class="input-group flex-nowrap mb-2">
                            <span class="input-group-text" id="addon-wrapping">{{ 'Phone' }}</span>
                            <input name="deputy_phone" type="text" class="form-control" aria-describedby="addon-wrapping" value="{{ setting()->get('deputy_phone') }}">
                        </div>
                        <div class="input-group">
                            <span class="input-group-btn">
                              <a
                                id="deputy_image_anchor"
                                data-input="deputy_image"
                                data-preview="deputy_holder"
                                class="btn btn-primary text-white">
                                <i class="cil-clipboard"></i>  {{ __('Choose File') }}
                              </a>
                            </span>
                            <input id="deputy_image" class="form-control" type="text" name="deputy_image" value="{{ setting()->get('deputy_image', 'https://place-hold.it/400x400') }}" readonly>
                        </div>
                        <div id="deputy_holder" style="margin-top:15px;max-height:100px;">
                        <img style="height: 5rem" src="{{ setting()->get('deputy_image', 'https://place-hold.it/400x400') }}">
                        </div>
                    </div>
                </div>



            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update Settings')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection

@include('backend.includes.partials.filemanager')

@push('after-scripts')
    <script>
        lfm('chairperson_image_anchor', 'image', {
            prefix: route_prefix,
            type: 'image'
        });
        jQuery('#chairperson_image_anchor').on('click', function(){
            jQuery('#chairperson_holder').html('');
            jQuery('#chairperson_image').val('').change();
        });
        lfm('executive_image_anchor', 'image', {
            prefix: route_prefix,
            type: 'image'
        });
        jQuery('#executive_image_anchor').on('click', function(){
            jQuery('#executive_holder').html('');
            jQuery('#executive_image').val('').change();
        });
        lfm('deputy_image_anchor', 'image', {
            prefix: route_prefix,
            type: 'image'
        });
        jQuery('#deputy_image_anchor').on('click', function(){
            jQuery('#deputy_holder').html('');
            jQuery('#deputy_image').val('').change();
        });
    </script>
@endpush
