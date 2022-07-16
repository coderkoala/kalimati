@inject('model', '\App\Domains\Auth\Models\User')

@extends('backend.layouts.app')

@section('title', __('Update License'))

@section('content')
    <x-forms.patch :action="route('admin.license.update', $data['id'])">
        <x-backend.card>
            <x-slot name="header">
                @lang('Update License')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.license.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                    <div>{!! render_html($fields, $data) !!}</div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update License')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.post>
@endsection
