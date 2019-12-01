<?php

namespace App\Services\Cache;

use Illuminate\Http\Request;

class CacheKeyManager {

    /**
     * @param Request $request
     * @return string
     */
    public function getRequestCategoriesKey(Request $request): string {
        return $this->getKey(
            Key::CATEGORIES_PREFIX,
            $this->generateRequestKeySuffix($request)
        );
    }

    /**
     * @param Request $request
     * @return string
     */
    public function getRequestAuthorsKey(Request $request): string {
        return $this->getKey(
            Key::AUTHORS_PREFIX,
            $this->generateRequestKeySuffix($request)
        );
    }

    /**
     * @param Request $request
     * @return string
     */
    public function getRequestCompilationsKey(Request $request): string {
        return $this->getKey(
            Key::COMPILATIONS_PREFIX,
            $this->generateRequestKeySuffix($request)
        );
    }

    /**
     * @param Request $request
     * @return string
     */
    public function getRequestFavoritesKey(Request $request): string {
        return $this->getKey(
            Key::FAVORITES_PREFIX,
            $this->generateRequestKeySuffix($request)
        );
    }

    /**
     * @param Request $request
     * @return string
     */
    public function getRequestHandbooksKey(Request $request): string {
        return $this->getKey(
            Key::HANDBOOKS_PREFIX,
            $this->generateRequestKeySuffix($request)
        );
    }

    /**
     * @param Request $request
     * @return string
     */
    public function getRequestJournalsKey(Request $request): string {
        return $this->getKey(
            Key::JOURNALS_PREFIX,
            $this->generateRequestKeySuffix($request)
        );
    }

    /**
     * @param Request $request
     * @return string
     */
    public function getRequestMaterialsKey(Request $request): string {
        return $this->getKey(
            Key::MATERIALS_PREFIX,
            $this->generateRequestKeySuffix($request)
        );
    }

    /**
     * @param Request $request
     * @return string
     */
    public function getRequestReviewsKey(Request $request): string {
        return $this->getKey(
            Key::REVIEWS_PREFIX,
            $this->generateRequestKeySuffix($request)
        );
    }

    /**
     * @param Request $request
     * @return string
     */
    public function getRequestSelectionMaterialsKey(Request $request): string {
        return $this->getKey(
            Key::SELECTION_MATERIALS_PREFIX,
            $this->generateRequestKeySuffix($request)
        );
    }


    /**
     * @param array $filters
     * @return string
     */
    public function getSearchCategoriesKey(array $filters = []): string {
        return $this->getKey(
            Key::CATEGORIES_PREFIX,
            $this->generateParamsKeySuffix(array_merge(
                [
                    'page' => request()->get('page'),
                ], $filters
            ))
        );
    }

    /**
     * @param array $filters
     * @return string
     */
    public function getSearchAuthorsKey(array $filters = []): string {
        return $this->getKey(
            Key::AUTHORS_PREFIX,
            $this->generateParamsKeySuffix(array_merge(
                [
                    'page' => request()->get('page'),
                ], $filters
            ))
        );
    }

    /**
     * @param array $filters
     * @return string
     */
    public function getSearchCompilationsKey(array $filters = []): string {
        return $this->getKey(
            Key::COMPILATIONS_PREFIX,
            $this->generateParamsKeySuffix(array_merge(
                [
                    'page' => request()->get('page'),
                ], $filters
            ))
        );
    }

    /**
     * @param array $filters
     * @return string
     */
    public function getSearchFavoritesKey(array $filters = []): string {
        return $this->getKey(
            Key::FAVORITES_PREFIX,
            $this->generateParamsKeySuffix(array_merge(
                [
                    'page' => request()->get('page'),
                ], $filters
            ))
        );
    }

    /**
     * @param array $filters
     * @return string
     */
    public function getSearchHandbooksKey(array $filters = []): string {
        return $this->getKey(
            Key::HANDBOOKS_PREFIX,
            $this->generateParamsKeySuffix(array_merge(
                [
                    'page' => request()->get('page'),
                ], $filters
            ))
        );
    }

    /**
     * @param array $filters
     * @return string
     */
    public function getSearchJournalsKey(array $filters = []): string {
        return $this->getKey(
            Key::JOURNALS_PREFIX,
            $this->generateParamsKeySuffix(array_merge(
                [
                    'page' => request()->get('page'),
                ], $filters
            ))
        );
    }

    /**
     * @param array $filters
     * @return string
     */
    public function getSearchMaterialsKey(array $filters = []): string {
        return $this->getKey(
            Key::MATERIALS_PREFIX,
            $this->generateParamsKeySuffix(array_merge(
                [
                    'page' => request()->get('page'),
                ], $filters
            ))
        );
    }

    /**
     * @param array $filters
     * @return string
     */
    public function getSearchReviewsKey(array $filters = []): string {
        return $this->getKey(
            Key::REVIEWS_PREFIX,
            $this->generateParamsKeySuffix(array_merge(
                [
                    'page' => request()->get('page'),
                ], $filters
            ))
        );
    }

    /**
     * @param array $filters
     * @return string
     */
    public function getSearchSelectionMaterialsKey(array $filters = []): string {
        return $this->getKey(
            Key::SELECTION_MATERIALS_PREFIX,
            $this->generateParamsKeySuffix(array_merge(
                [
                    'page' => request()->get('page'),
                ], $filters
            ))
        );
    }

    /**
     * @param Request $request
     * @param array|null $keys
     * @return string
     */
    private function generateRequestKeySuffix(Request $request, ?array $keys = null): string {
        return $this->generateParamsKeySuffix([
            $request->fullUrl(),
            $request->all($keys),
        ]);
    }

    /**
     * @param array $params
     * @return string
     */
    private function generateParamsKeySuffix(array $params): string {
        return md5(implode('|', $params));
    }

    /**
     * @param string $prefix
     * @param string|null $suffix
     * @return string
     */
    private function getKey(string $prefix, ?string $suffix = null): string {
        if (!$suffix) {
            return $prefix;
        }
        return sprintf('%s|%s', $prefix, $suffix);
    }
}
