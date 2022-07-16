<?php

namespace App\Http\Livewire\Backend;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Backend\PriceLog;

/**
 * Class ArticleTable.
 */
class PriceShowTable extends DataTableComponent
{
    /**
     * @var
     */
    public $entry_date;

    public bool $showSearch = false;

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return PriceLog::join('commodities', 'commodities.commodity_id', '=', 'daily_price_log.commodity_id')
        ->select(
            'daily_price_log.id',
            'commodities.' . "commodity_" . app()->getLocale() . ' as commodity',
            'daily_price_log.price_type',
            'daily_price_log.min_price',
            'daily_price_log.max_price',
            'daily_price_log.avg_price',
            )
        ->where('daily_price_log.entry_date', $this->entry_date )
        ->where('commodities.deleted_at', null);
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Commodity Name'), 'commodity')->sortable(),
            Column::make(__('Price Type'), "commodity_price_type" ),
            Column::make(__('Minimum Price'), "commodity_min_price" ),
            Column::make(__('Average Price'), "commodity_avg_price" ),
            Column::make(__('Maximum Price'), "commodity_max_price" ),
        ];
    }

    /**
     * @return string
     */
    public function rowView(): string
    {
        return 'backend.pricelog.includes.row-single';
    }
}
