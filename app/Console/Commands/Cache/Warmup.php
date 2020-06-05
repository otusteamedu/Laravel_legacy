<?php

namespace App\Console\Commands\Cache;

use App\Services\Cache\CachesService;
use Illuminate\Console\Command;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

class Warmup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mine:cache:warmup
            {model?* : Model list}
             {--A|all : All caches}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Warmup caches, one by one or all';
    /**
     * @var CachesService
     */
    private CachesService $cachesService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CachesService $cachesService)
    {
        parent::__construct();
        $this->cachesService = $cachesService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $all = $this->option('all');
        $models = $this->arguments()['model'];
        if($all){
            $model_names = $this->getModels();
            $list = [];
            $i = 0;
            foreach ($model_names as $name){
                $list[$i]['number'] = $i;
                $list[$i]['name'] = $name;
                $shot_model_name = substr($name, strrpos($name, '\\') + 1);
                $cache_class = 'Cached' . $shot_model_name . 'Repository';
                if(class_exists($cache_class)){
                    $this->info($shot_model_name);

                }
                $i++;
            }
            $headers = ['N#', 'Name'];
            $this->info('Models list :');
            $this->table($headers, $list);
            $this->cachesService->warmup([]);
            return $this->info('Finished');
        }




    }

    /**
     * @return Collection | Models list
     */
    private function getModels(): Collection
    {
        $models = collect(File::allFiles(app_path()))
            ->map(function ($item) {
                $path = $item->getRelativePathName();
                $class = sprintf('\%s%s',
                    Container::getInstance()->getNamespace(),
                    strtr(substr($path, 0, strrpos($path, '.')), '/', '\\'));

                return $class;
            })
            ->filter(function ($class) {
                $valid = false;

                if (class_exists($class)) {
                    $reflection = new \ReflectionClass($class);
                    $valid = $reflection->isSubclassOf(Model::class) &&
                        !$reflection->isAbstract();
                }

                return $valid;
            });

        return $models->values();
    }
}
