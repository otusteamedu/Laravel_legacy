<?php

namespace App\Builders;

use App\Http\Requests\FormRequest;

/**
 * Class RequestQueryBuilder
 *
 * @package App\Builders
 */
class RequestQueryBuilder extends FormRequest
{
    /** @var int */
    const MAX_PER_PAGE = 20;

    /** @var QueryBuilder */
    private $builder;

    /**
     * @return string[]
     */
    public function rules()
    {
        return [
            'limit' => 'nullable|integer|min:1|max:' . self::MAX_PER_PAGE,
            'offset' => 'nullable|integer|min:0',
        ];
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->request->get('limit', self::MAX_PER_PAGE);
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->request->get('offset', 0);
    }

    /**
     * @return QueryBuilder
     */
    public function getBuilder()
    {
        if ($this->builder) {
            return $this->builder;
        }

        $this->builder = new QueryBuilder();

        $this->builder->setLimit($this->getLimit())->setOffset($this->getOffset());

        return $this->builder;
    }

}
