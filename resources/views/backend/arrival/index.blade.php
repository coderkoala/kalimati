@extends('backend.layouts.app')

@section('title', __('Daily Arrival Management'))

@inject('user', '\App\Domains\Auth\Models\User')

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Daily Arrival Management')
        </x-slot>


        @if ($logged_in_user->can('admin.arrival.create'))
            <x-slot name="headerActions">
                <x-utils.link icon="c-icon cil-plus" class="card-header-action" :href="route('admin.arrival.create')" :text="__('Create a new Arrival Log')" />
            </x-slot>
        @endif

        <x-slot name="body">
            <div class="alert alert-warning" role="alert">
                {{ __("Please note that deleting an arrival log will remove all related data for that day!") }}
            </div>
            <livewire:backend.arrival-table />
        </x-slot>
    </x-backend.card>
@endsection
