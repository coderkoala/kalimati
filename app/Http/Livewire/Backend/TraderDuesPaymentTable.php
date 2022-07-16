<?php

namespace App\Http\Livewire\Backend;

use App\Models\Backend\TraderDuesPayment;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class TraderDuesPaymentTable.
 */
class TraderDuesPaymentTable extends DataTableComponent
{
    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return TraderDuesPayment::orderBy('id')
            ->when($this->getFilter('search'), fn ($query, $term) => $query->search($term));
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Transaction Invoice'), 'vendor_id')
                ->sortable(),
            Column::make(__('Customer Email'), 'notify_email')
                ->sortable(),
            Column::make(__('Payment Channel'), 'payment_channel')
                ->sortable(),
            Column::make(__('Paid On'), 'paid_on'),
            Column::make(__('Status'), 'status'),
            Column::make(__('Amount Paid'), 'amount_paid'),
            Column::make(__('View')),
        ];
    }

    /**
     * @return string
     */
    public function rowView(): string
    {
        return 'backend.traderduespayment.includes.row';
    }
}
