@inject('model', '\App\Domains\Auth\Models\User')

@extends('backend.layouts.app')

@section('title', __('Create New License'))

@section('content')
    <x-forms.post :action="route('admin.license.store')">
        <x-backend.card>
            <x-slot name="header">
                @lang('Create New License')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.license.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                    <div>{!! render_html($fields) !!}</div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Create New License')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection
