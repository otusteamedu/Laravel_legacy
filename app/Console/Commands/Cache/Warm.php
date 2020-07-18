<?php

namespace App\Console\Commands\Cache;

use App\Services\Courses\CourseService;
use App\Services\Groups\GroupService;
use App\Services\Interfaces\CacheService;
use App\Services\Students\StudentService;
use App\Services\Teachers\TeacherService;
use App\Services\Years\YearService;
use Illuminate\Console\Command;

class Warm extends Command
{
    const COURSE = 'course';
    const GROUP = 'group';
    const STUDENT = 'student';
    const TEACHER = 'teacher';
    const YEAR = 'year';

    const ALL = 'all';
    const SERVICE = 'service';
    const FORCE = 'force';
    const STOP = 'stop choosing';

    /**
     * @var array
     */
    private $services = [];
    /**
     * @var array
     */
    private $servicesForWarm = [];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:warm
                            {--all : select all services for caching}
                            {--service=* : choose some services for caching}
                            {--force : do not ask for choosing more services for caching}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Warm cache through services.';

    /**
     * Create a new command instance.
     *
     * @param CourseService $courseService
     * @param GroupService $groupService
     * @param StudentService $studentService
     * @param TeacherService $teacherService
     * @param YearService $yearService
     */
    public function __construct(
        CourseService $courseService,
        GroupService $groupService,
        StudentService $studentService,
        TeacherService $teacherService,
        YearService $yearService
    ) {
        parent::__construct();

        $this->services = [
            static::COURSE => $courseService,
            static::GROUP  => $groupService,
            static::STUDENT => $studentService,
            static::TEACHER => $teacherService,
            static::YEAR => $yearService,
        ];
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->prepareServicesForWarmFromOptions();
        $this->warm();
    }

    /**
     * @param string $key
     * @return CacheService|null
     */
    private function getService(string $key): ?CacheService
    {
        if (!isset($this->services[$key])) {
            $this->error('There is no alias for ' . $key);
            return null;
        }

        return $this->services[$key];
    }

    private function prepareServicesForWarmFromOptions(): void
    {
        if ($this->option(static::ALL)) {
            $this->servicesForWarm = $this->services;
            return;
        }

        if ($this->option(static::SERVICE)) {
            foreach ($this->option(static::SERVICE) as $key) {
                if ($service = $this->getService($key)) {
                    $this->servicesForWarm[$key] = $service;
                }
            }
        }

        $this->prepareServicesForWarmFromInput();
    }

    private function prepareServicesForWarmFromInput(): void
    {
        if ($this->option(static::FORCE)) {
            return;
        }

        $keys = array_diff(
            array_keys($this->services),
            array_keys($this->servicesForWarm)
        );

        if (empty($keys)) {
            return;
        }

        $key = $this->askForSettingServicesForWarm($keys);
        if ($key === static::ALL) {
            $this->servicesForWarm = $this->services;
            return;
        }
        if ($key === static::STOP) {
            return;
        }

        $this->servicesForWarm[$key] = $this->getService($key);
        $this->prepareServicesForWarmFromInput();
    }

    private function askForSettingServicesForWarm(array $keys): string
    {
        $keys[] = static::ALL;
        $keys[] = static::STOP;

        return $this->choice('Choice service for warm:', $keys, static::STOP);
    }

    private function warm(): void
    {
        collect($this->servicesForWarm)->each(function (CacheService $service, string $key): void {
            $this->info('Prepare for caching . ' . $key);
            $service->clearCache();

            $this->info('Start caching ' . $key);
            $service->cacheWarm();
            $this->info('End caching ' . $key);
        });
    }
}
