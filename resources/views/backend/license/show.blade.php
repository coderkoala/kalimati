@inject('model', '\App\Domains\Auth\Models\User')

@extends('backend.layouts.app')

@section('title', __('View License'))

@section('content')
        <x-backend.card>
            <x-slot name="header">
                @lang('View License')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.license.index')" :text="__('Back')" />
            </x-slot>

            <x-slot name="body">
                    <div>{!! render_html($fields, $data) !!}</div>
            </x-slot>
        </x-backend.card>
@endsection
