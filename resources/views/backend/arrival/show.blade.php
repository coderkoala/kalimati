@inject('user', '\App\Domains\Auth\Models\User')

@extends('backend.layouts.app')

@section('title', __('View Arrival Log'))

@section('content')
        <x-backend.card>
            <x-slot name="header">
                @lang('View Arrival Log')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.arrival.index')" :text="__('Back')" />
            </x-slot>

            <x-slot name="body">
                <livewire:backend.arrival-show-table :entry_date="$entry_date" />
            </x-slot>
        </x-backend.card>
@endsection
