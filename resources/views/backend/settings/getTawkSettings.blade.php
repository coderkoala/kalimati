@inject('model', '\App\Domains\Auth\Models\User')

@extends('backend.layouts.app')

@section('title', __('Create New License'))

@section('content')
    <x-forms.post :action="route('admin.setting')">
        <x-backend.card>
            <x-slot name="header">
                @lang('All API Settings')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.dashboard')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">{{ __('Chat App API Key') }}</label>
                    <div class="col-md-10">
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text" id="addon-wrapping">{{ 'Widget API Key' }}</span>
                            <input name="API_TAWK_KEY" type="text" class="form-control" aria-describedby="addon-wrapping" value="{{ setting()->get('API_TAWK_KEY', "62b413377b967b11799613cd") }}">
                        </div>
                        <div class="input-group flex-nowrap pt-3">
                            <span class="input-group-text" id="addon-wrapping">{{ 'Chat widget ID' }}</span>
                            <input name="API_TAWK_WID" type="text" class="form-control" aria-describedby="addon-wrapping" value="{{ setting()->get('API_TAWK_WID', "1g67mm4nj") }}">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">{{ __('Google API Settings') }}</label>
                    <div class="col-md-10">
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text" id="addon-wrapping">{{ 'Google Analytics V3 API Key' }}</span>
                            <input name="API_GOOGLE_ANALYTICS" type="text" class="form-control" aria-describedby="addon-wrapping" value="{{ setting()->get('API_GOOGLE_ANALYTICS', "UA-231777614-1") }}">
                        </div>
                        <div class="input-group flex-nowrap pt-3">
                            <span class="input-group-text" id="addon-wrapping">{{ 'Google Analytics V4 API Key' }}</span>
                            <input name="API_GOOGLE_ANALYTICS_V4" type="text" class="form-control" aria-describedby="addon-wrapping" value="{{ setting()->get('API_GOOGLE_ANALYTICS_V4', "G-L5VW285Y3D") }}">
                        </div>
                        <div class="input-group flex-nowrap pt-3">
                            <span class="input-group-text" id="addon-wrapping">{{ 'Google Recaptcha API Key' }}</span>
                            <input name="API_GOOGLE_RECAPTCHA" type="text" class="form-control" aria-describedby="addon-wrapping" value="{{ setting()->get('API_GOOGLE_RECAPTCHA', "6LcS9mUgAAAAAJKJwM_985qaqQ4H4FpgMMBjz7Xt") }}">
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
