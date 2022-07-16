<?php

namespace App\Http\Livewire\Backend;

use App\Models\Backend\TraderDues;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

/**
 * Class LicenseTable.
 */
class TraderDuesTable extends DataTableComponent
{
    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return TraderDues::orderBy('tradername')
            ->when($this->getFilter('search'), fn ($query, $term) => $query->search($term));
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Trader ID'), 'trader_id')->searchable(),
            Column::make(__('Trader Name'), 'tradername')->searchable(),
            Column::make(__('Stall ID'), 'shop_id')->searchable(),
            Column::make(__('Due Date'), 'due_date'),
            Column::make(__('Monthly Rent'), 'monthly_rent'),
            Column::make(__('Late Fees'), 'late_fee'),
            Column::make(__('Other Amount'), 'other_amount'),
            Column::make(__('Adjustment'), 'adjustment'),
            Column::make(__('Total Amount'), 'total_amount'),
            Column::make(__('Actions')),
        ];
    }

    /**
     * @return string
     */
    public function rowView(): string
    {
        return 'backend.traderdues.includes.row';
    }
}
