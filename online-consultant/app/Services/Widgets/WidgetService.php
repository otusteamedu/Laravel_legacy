<?php

namespace App\Services\Widgets;

use App\Models\Widget;
use App\Repositories\Widgets\WidgetRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class WidgetService
{
    private $repository;
    
    public function __construct(WidgetRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * Get all widgets
     *
     * @param  array  $columns
     *
     * @return Collection
     */
    public function allWidgets($columns = []): Collection
    {
        return $this->repository->all($columns);
    }
    
    /**
     * Get paginated widgets
     *
     * @param  int  $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginateWidgets(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }
    
    /**
     * Paginate widgets incl. trashed
     *
     * @param  int  $perPage
     *
     * @return LengthAwarePaginator
     */
    public function paginateWidgetsWithTrashed(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginateWithTrashed($perPage);
    }
    
    /**
     * Create widget
     *
     * @param  array  $data
     *
     * @return Widget
     */
    public function createWidget(array $data): Widget
    {
        return $this->repository->create($data);
    }
    
    /**
     * Find widget by id
     *
     * @param  int  $id
     *
     * @return Widget|null
     */
    public function findWidget(int $id): ?Widget
    {
        return $this->repository->find($id);
    }
    
    /**
     * Find widget by id incl. trashed
     *
     * @param  int  $id
     *
     * @return Widget|null
     */
    public function findWidgetWithTrashed(int $id): ?Widget
    {
        return $this->repository->findWithTrashed($id);
    }
    
    /**
     * Update widget
     *
     * @param  Widget  $widget
     * @param  array  $data
     *
     * @return Widget
     */
    public function updateWidget(Widget $widget, array $data): Widget
    {
        return $this->repository->update($widget, $data);
    }
    
    /**
     * Delete widget
     *
     * @param  Widget  $widget
     *
     * @return bool|null
     * @throws \Exception
     */
    public function deleteWidget(Widget $widget): ?bool
    {
        return $this->repository->delete($widget);
    }
    
    /**
     * Restore widget
     *
     * @param  int  $id
     *
     * @return bool|null
     */
    public function restoreWidget(int $id): ?bool
    {
        $widget = $this->findWidgetWithTrashed($id);
        
        if (!$widget) {
            return false;
        }
        
        return $this->repository->restore($widget);
    }
    
    /**
     * Permanently delete widget
     *
     * @param  int  $id
     *
     * @return bool|null
     */
    public function forceDeleteWidget(int $id): ?bool
    {
        $widget = $this->findWidgetWithTrashed($id);
        
        if (!$widget) {
            return false;
        }
        
        return $this->repository->forceDelete($widget);
    }
    
    /**
     * Get array of widgets for form select
     *
     * @return array
     */
    public function getFormSelectWidgets(): array
    {
        $formSelectWidgets = [];
        $rawWidgets = $this->repository->getFormSelectOptions(['id', 'domain']);
        
        if (count($rawWidgets) === 0) {
            return $formSelectWidgets;
        }
        
        foreach ($rawWidgets as $widget) {
            $formSelectWidgets[$widget['id']] = $widget['domain'];
        }
        
        return $formSelectWidgets;
    }
}
