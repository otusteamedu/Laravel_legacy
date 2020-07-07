<?php

namespace Tests\Feature\Requests;

use App\Http\Controllers\Groups\Requests\IndexGroupRequest;

trait RequestTrait
{
    /**
     * @test
     * @dataProvider validationProvider
     * @param bool $shouldPass
     * @param array $mockedRequestData
     */
    public function validationResultsAsExpected($shouldPass, $mockedRequestData): void
    {
        $this->assertEquals(
            $shouldPass,
            $this->validate($mockedRequestData)
        );
    }

    /**
     * @param $mockedRequestData
     * @return bool
     */
    protected function validate($mockedRequestData): bool
    {
        return $this->validator
            ->make($mockedRequestData, $this->rules)
            ->passes();
    }
}
