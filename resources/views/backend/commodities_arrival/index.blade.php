@extends('backend.layouts.app')

@section('title', __('Arrival Commodity Management'))

@inject('user', '\App\Domains\Auth\Models\User')

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Arrival Commodity Management')
        </x-slot>

        @if ($logged_in_user->can('admin.commodities-arrival.create'))
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.commodities-arrival.create')"
                    :text="__('Create a new Commodity')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:backend.commodities-arrival-table />
        </x-slot>
    </x-backend.card>
@endsection
