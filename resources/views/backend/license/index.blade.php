@extends('backend.layouts.app')

@section('title', __('License Management'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('License Management')
        </x-slot>

        @if ($logged_in_user->can('backend.license.create'))
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.license.create')"
                    :text="__('Create a new License')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:backend.license-table />
        </x-slot>
    </x-backend.card>
@endsection
