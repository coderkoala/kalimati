<?php

namespace App\Http\Livewire\Backend;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Backend\Articles as table_model;

/**
 * Class ArticleTable.
 */
class ArticlesTable extends DataTableComponent
{
    /**
     * @var
     */
    public $status;

    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return table_model::withTrashed()->orderBy('id')
            ->when($this->getFilter('search'), fn ($query, $term) => $query->search($term));
    }

    /**
     * @return array
     */
    public function columns(): array
    {
        return [
            Column::make(__('Title'), 'name')
                ->sortable(),
            Column::make(__('Slug'), 'slug')
                ->sortable(),
            Column::make(__('Author'), 'author')
                ->sortable(),
            Column::make(__('Created On'), 'created_at')->sortable(),
            Column::make(__('Status'), 'status'),
            Column::make(__('Actions')),
        ];
    }

    /**
     * @return string
     */
    public function rowView(): string
    {
        return 'backend.articles.includes.row';
    }
}
