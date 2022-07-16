@inject('user', '\App\Domains\Auth\Models\User')

@extends('backend.layouts.app')

@section('title', __('View Price Log'))

@section('content')
        <x-backend.card>
            <x-slot name="header">
                @lang('View Price Log')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.pricelog.index')" :text="__('Back')" />
            </x-slot>

            <x-slot name="body">
                <livewire:backend.price-show-table :entry_date="$entry_date" />
            </x-slot>
        </x-backend.card>
@endsection
