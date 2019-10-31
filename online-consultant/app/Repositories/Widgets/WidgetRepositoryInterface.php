<?php

namespace App\Repositories\Widgets;

use App\Models\Widget;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface WidgetRepositoryInterface
{
    /**
     * Get all widgets
     *
     * @param  array  $columns
     *
     * @return Collection
     */
    public function all($columns = ['*']): Collection;
    
    /**
     * Paginate widgets
     *
     * @param  int  $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 15): LengthAwarePaginator;
    
    /**
     * Paginate widgets incl. trashed
     *
     * @param  int  $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginateWithTrashed(int $perPage = 15): LengthAwarePaginator;
    
    /**
     * Create widget
     *
     * @param  array  $data
     *
     * @return Widget
     */
    public function create(array $data): Widget;
    
    /**
     * Find widget by id
     *
     * @param  int  $id
     *
     * @return Widget|null
     */
    public function find(int $id): ?Widget;
    
    /**
     * Find widget by id incl. trashed
     *
     * @param  int  $id
     *
     * @return Widget|null
     */
    public function findWithTrashed(int $id): ?Widget;
    
    /**
     * Update widget
     *
     * @param  Widget  $widget
     * @param  array  $data
     *
     * @return Widget
     */
    public function update(Widget $widget, array $data): Widget;
    
    /**
     * Delete widget
     *
     * @param  Widget  $widget
     *
     * @return bool|null
     */
    public function delete(Widget $widget): ?bool;
    
    /**
     * Restore widget
     *
     * @param  Widget  $widget
     *
     * @return bool|null
     */
    public function restore(Widget $widget): ?bool;
    
    /**
     * Permanently delete widget
     *
     * @param  Widget  $widget
     *
     * @return bool|null
     */
    public function forceDelete(Widget $widget): ?bool;
    
    /**
     * Get array of widgets for form select
     *
     * @param  array  $columns
     *
     * @return Widget[]|array|Collection
     */
    public function getFormSelectOptions($columns = []);
}
