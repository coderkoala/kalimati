@extends('backend.layouts.app')

@section('title', __('Notice, Reports and Publications'))

@inject('user', '\App\Domains\Auth\Models\User')

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Notice, Reports and Publications')
        </x-slot>

        @if ($logged_in_user->can('admin.notices.create'))
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.notices.create')"
                    :text="__('Create New')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:backend.notices-table />
        </x-slot>
    </x-backend.card>
@endsection
