@inject('user', '\App\Domains\Auth\Models\User')

@extends('backend.layouts.app')

@section('title', __('View Due Report'))

@section('content')
        <x-backend.card>
            <x-slot name="header">
                @lang('View Due Report')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.traderdues.index')" :text="__('Back')" />
            </x-slot>

            <x-slot name="body">
                    <div>{!! render_html($fields, $data) !!}</div>
            </x-slot>
        </x-backend.card>
@endsection
