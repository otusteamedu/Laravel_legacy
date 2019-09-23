<?php

namespace App\Repositories\Widgets;

use App\Models\Widget;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class EloquentWidgetRepository implements WidgetRepositoryInterface
{
    /**
     * Get all widgets
     *
     * @param  array  $columns
     *
     * @return Collection
     */
    public function all($columns = []): Collection
    {
        return Widget::all($columns);
    }
    
    /**
     * Paginate widgets
     *
     * @param  int  $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->withCompany()->paginate($perPage);
    }
    
    /**
     * Paginate widgets incl. trashed
     *
     * @param  int  $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginateWithTrashed(int $perPage = 15): LengthAwarePaginator
    {
        return $this->withCompany()->withTrashed()->paginate($perPage);
    }
    
    /**
     * Eager loading for companies
     *
     * @return Widget|Builder
     */
    public function withCompany()
    {
        return Widget::with('company');
    }
    
    /**
     * Create widget
     *
     * @param  array  $data
     *
     * @return Widget
     */
    public function create(array $data): Widget
    {
        $widget = new Widget();
        $widget->fill($data);
        $widget->save();
        
        return $widget;
    }
    
    /**
     * Find widget by id
     *
     * @param  int  $id
     *
     * @return Widget|null
     */
    public function find(int $id): ?Widget
    {
        return Widget::find($id);
    }
    
    /**
     * Find widget by id incl. trashed
     *
     * @param  int  $id
     *
     * @return Widget|null
     */
    public function findWithTrashed(int $id): ?Widget
    {
        return Widget::withTrashed()->find($id);
    }
    
    /**
     * Update widget
     *
     * @param  Widget  $widget
     * @param  array  $data
     *
     * @return Widget
     */
    public function update(Widget $widget, array $data): Widget
    {
        $widget->update($data);
        
        return $widget;
    }
    
    /**
     * Delete widget
     *
     * @param  Widget  $widget
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete(Widget $widget): ?bool
    {
        return $widget->delete();
    }
    
    /**
     * Restore widget
     *
     * @param  Widget  $widget
     *
     * @return bool|null
     */
    public function restore(Widget $widget): ?bool
    {
        return $widget->restore();
    }
    
    /**
     * Permanently delete widget
     *
     * @param  Widget  $widget
     *
     * @return bool|null
     */
    public function forceDelete(Widget $widget): ?bool
    {
        return $widget->forceDelete();
    }
    
    /**
     * Get array of widgets for form select
     *
     * @param  array  $columns
     *
     * @return Widget[]|array|Collection
     */
    public function getFormSelectOptions($columns = [])
    {
        return $this->all($columns)->toArray();
    }
}
