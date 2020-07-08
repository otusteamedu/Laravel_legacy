<?php

namespace Tests\Unit\Services;

use App\Models\EducationYear;
use App\Services\Years\YearService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class EducationYearServiceTest
 * @package Tests\Unit\Services
 * @group education_year
 */
class EducationYearServiceTest extends TestCase
{
    use RefreshDatabase;

    const FORMAT = 'Y-m-d';

    /**
     * @var YearService
     */
    protected $service;

    public function setUp(): void
    {
        parent::setUp();

        $this->service = resolve(YearService::class);
    }

    /**
     * @test
     */
    public function educationYearSelectList(): void
    {
        $year = \factory(EducationYear::class)->create();

        $this->assertEquals([
            $year->id => $year->start_at->format(static::FORMAT) . ' - ' . $year->end_at->format(static::FORMAT)
        ], $this->service->educationYearSelectList());
    }
}
