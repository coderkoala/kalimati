@extends('backend.layouts.app')

@section('title', __('Update Price Log'))

@inject('user', '\App\Domains\Auth\Models\User')

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Update Price Log')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link class="card-header-action" :href="route('admin.pricelog.index')" :text="__('Cancel')" />
        </x-slot>

        <x-slot name="body">
            <table class="table table-striped table-bordered" id="editTablePriceLog">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">{{ __('Commodity') }}</th>
                        <th scope="col">{{ __('Minimum Price') }}</th>
                        <th scope="col">{{ __('Average Price') }}</th>
                        <th scope="col">{{ __('Maximum Price') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $tuple)
                        <tr>
                            <td id="{{ $tuple->id }}">
                                {{ $commodities->where('commodity_id', $tuple->commodity_id)->first()->commodity }}</td>
                            <td val="{{ $tuple->min_price }}">{{ $tuple->min_price }}</td>
                            <td val="{{ $tuple->avg_price }}">{{ $tuple->avg_price }}</td>
                            <td val="{{ $tuple->max_price }}">{{ $tuple->max_price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-slot>
    </x-backend.card>
@endsection

@push('after-scripts')
    <script></script>
    <script>
        (function($) {
            var revertfunction = function(data, show = true) {
                if (show) {
                    Swal.fire({
                        title: '{{ __('Error') }}',
                        text: '{{ __('Invalid price input detected. Please correct and try again.') }}',
                        icon: "error",
                        confirmButtonText: '{{ __('Ok') }}'
                    });
                }

                // Revert the changes to the table.
                jQuery(data.first()).children()[1].innerHTML = jQuery(jQuery(data.first()).children()[1]).attr(
                    'val');
                jQuery(data.first()).children()[2].innerHTML = jQuery(jQuery(data.first()).children()[2]).attr(
                    'val');
                jQuery(data.first()).children()[3].innerHTML = jQuery(jQuery(data.first()).children()[3]).attr(
                    'val');
                return false;
            }
            var editTablePriceLog = new BSTable("editTablePriceLog", {
                editableColumns: "1,2,3",
                onEdit: function(data) {
                    var postData = {
                        'id': jQuery(data.first()).children()[0].id,
                        'min_price': parseFloat(jQuery(data.first()).children()[1].innerHTML),
                        'avg_price': parseFloat(jQuery(data.first()).children()[2].innerHTML),
                        'max_price': parseFloat(jQuery(data.first()).children()[3].innerHTML),
                        '_token': '{{ csrf_token() }}',
                    };

                    var endpoint = "{{ route('admin.pricelog.update', '') }}";
                    endpoint = endpoint + '/' + postData.id;

                    // If any of the properties in postData are NaN, fire a sweet alert message.
                    if (isNaN(postData.min_price) || isNaN(postData.avg_price) || isNaN(postData
                        .max_price)) {
                        return revertfunction(data);
                    }

                    try {
                        jQuery.ajax({
                            type: 'PATCH',
                            url: endpoint,
                            data: postData,
                            success: function(response) {
                                Swal.fire({
                                    title: '{{ __('Success') }}',
                                    text: response.message,
                                    icon: "success",
                                    confirmButtonText: '{{ __('Ok') }}'
                                });
                                jQuery(data.first()).children()[1].setAttribute('val', postData
                                    .min_price);
                                jQuery(data.first()).children()[2].setAttribute('val', postData
                                    .avg_price);
                                jQuery(data.first()).children()[3].setAttribute('val', postData
                                    .max_price);
                            },
                            error: function(response) {
                                Swal.fire({
                                    title: '{{ __('Error') }}',
                                    text: response.responseJSON.message,
                                    icon: "error",
                                    confirmButtonText: '{{ __('Ok') }}'
                                });
                                return revertfunction(data, false);
                            }
                        });
                    } catch (e) {
                        Swal.fire({
                            title: '{{ __('Error') }}',
                            text: '{{ __('An error occurred while updating the price log.') }}',
                            icon: "error",
                            confirmButtonText: '{{ __('Ok') }}'
                        });
                        revertfunction(data, false);
                    }
                },
                advanced: {
                    columnLabel: "{{ __('Actions') }}",
                    buttonHTML: `<div class="btn-group pull-right">
                        <button id="bEdit" type="button" class="btn btn-sm btn-default">
                            <span class="fa fa-edit" > </span>
                        </button>
                        <button id="bAcep" type="button" class="btn btn-sm btn-default" style="display:none;">
                            <span class="fa fa-check-circle" > </span>
                        </button>
                        <button id="bCanc" type="button" class="btn btn-sm btn-default" style="display:none;">
                            <span class="fa fa-times-circle" > </span>
                        </button>
                    </div>`
                }
            });
            editTablePriceLog.init();
        })(jQuery);
    </script>
@endpush
