<?php

namespace App\Services\Widgets;

use App\Models\Widget;
use App\Repositories\Widgets\WidgetRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class WidgetService
{
    private $widgetRepository;
    
    public function __construct(WidgetRepositoryInterface $widgetRepository)
    {
        $this->widgetRepository = $widgetRepository;
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
        return $this->widgetRepository->all($columns);
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
        return $this->widgetRepository->paginate($perPage);
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
        return $this->widgetRepository->paginateWithTrashed($perPage);
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
        return $this->widgetRepository->create($data);
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
        return $this->widgetRepository->find($id);
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
        return $this->widgetRepository->findWithTrashed($id);
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
        return $this->widgetRepository->update($widget, $data);
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
        return $this->widgetRepository->delete($widget);
    }
    
    /**
     * Restore widget
     *
     * @param  Widget  $widget
     *
     * @return bool|null
     */
    public function restoreWidget(Widget $widget): ?bool
    {
        return $this->widgetRepository->restore($widget);
    }
    
    /**
     * Permanently delete widget
     *
     * @param  Widget  $widget
     *
     * @return bool|null
     */
    public function forceDeleteWidget(Widget $widget): ?bool
    {
        return $this->widgetRepository->forceDelete($widget);
    }
    
    /**
     * Get array of widgets for form select
     *
     * @return array
     */
    public function getFormSelectWidgets(): array
    {
        $formSelectWidgets = [];
        $rawWidgets = $this->widgetRepository->getFormSelectOptions(['id', 'domain']);
        
        if (count($rawWidgets) === 0) {
            return $formSelectWidgets;
        }
        
        foreach ($rawWidgets as $widget) {
            $formSelectWidgets[$widget['id']] = $widget['domain'];
        }
        
        return $formSelectWidgets;
    }
}
