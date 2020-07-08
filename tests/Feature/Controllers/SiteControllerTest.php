<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;

/**
 * Class TeacherControllerTest
 * @package Tests\Feature\Controllers
 * @group teacher
 * @group other
 */
class SiteControllerTest extends TestCase
{

    /**
     * GET /dashboard/teachers
     */
    public function testIndex(): void
    {
        $this->get(route('main'))
            ->assertOk();
    }
}
