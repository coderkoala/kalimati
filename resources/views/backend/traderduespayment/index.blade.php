@extends('backend.layouts.app')

@section('title', __('Transaction Details'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Transaction Details')
        </x-slot>

        <x-slot name="body">
            <livewire:backend.trader-dues-payment-table />
        </x-slot>
    </x-backend.card>
@endsection
