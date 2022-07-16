@inject('model', '\App\Domains\Auth\Models\User')

@extends('backend.layouts.app')

@section('title', __('Create New License'))

@section('content')
    <x-forms.post :action="route('admin.setting')">
        <x-backend.card>
            <x-slot name="header">
                @lang('Site Options')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.dashboard')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">{{ __('Organization Structure') }}</label>
                    <div class="col-md-10">
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text" id="addon-wrapping"><i class="fa fa-lock text-success" aria-hidden="true"></i></span>
                            <input name="url_organization_structure" type="text" class="form-control" aria-describedby="addon-wrapping" value="{{ setting()->get('url_organization_structure', null) }}">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">{{ __('Citizen Charter') }}</label>
                    <div class="col-md-10">
                        <div class="input-group flex-nowrap pt-3">
                            <span class="input-group-text" id="addon-wrapping"><i class="fa fa-lock text-success" aria-hidden="true"></i></span>
                            <input name="url_citizen_charter" type="text" class="form-control" aria-describedby="addon-wrapping" value="{{ setting()->get('url_citizen_charter', null) }}">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">{{ __('Message From Director') }}</label>
                    <div class="col-md-10">
                        <div class="input-group flex-nowrap pt-3">
                            <span class="input-group-text" id="addon-wrapping">{!! 'true' === setting()->get('show_message_from_director', 'false') ? '<i class="fa fa-check text-success" aria-hidden="true"></i>' : '<i class="fa fa-times text-danger" aria-hidden="true"></i>' !!}</span>
                            <select name="show_message_from_director" class="form-control" id="show_message_from_director">
                                <option value="false" {{ 'false' === setting()->get('show_message_from_director', 'false') ? 'selected' : '' }}>{{ __('Hide') }}</option>
                                <option value="true" {{ 'true' === setting()->get('show_message_from_director', 'false') ? 'selected' : '' }}>{{ __('Show') }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2 col-form-label">{{ __('Our History') }}</label>
                    <div class="col-md-10">
                        <div class="input-group flex-nowrap pt-3">
                            <span class="input-group-text" id="addon-wrapping">{!! 'true' === setting()->get('show_our_history', 'false') ? '<i class="fa fa-check text-success" aria-hidden="true"></i>' : '<i class="fa fa-times text-danger" aria-hidden="true"></i>' !!}</span>
                            <select name="show_our_history" class="form-control" id="show_our_history">
                                <option value="false" {{ 'false' === setting()->get('show_our_history', 'false') ? 'selected' : '' }}>{{ __('Hide') }}</option>
                                <option value="true" {{ 'true' === setting()->get('show_our_history', 'false') ? 'selected' : '' }}>{{ __('Show') }}</option>
                            </select>
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
