@inject('user', '\App\Domains\Auth\Models\User')

@extends('backend.layouts.app')

@section('title', __('View Notice/Publication'))

@section('content')
        <x-backend.card>
            <x-slot name="header">
                @lang('View Notice/Publication')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.notices.index')" :text="__('Back')" />
            </x-slot>

            <x-slot name="body">
                    <div>{!! render_html($fields, $data) !!}</div>
            </x-slot>
        </x-backend.card>
@endsection
