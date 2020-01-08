<?php


namespace App\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ModelEvent
{
    const STORED = 1;
    const UPDATED = 2;
    const DELETING = 3;

    use Dispatchable, SerializesModels; // InteractsWithSockets
    /**
     * @var Model
     */
    private $model;
    /**
     * @var int
     */
    private $action;
    /**
     * @var mixed
     */
    private $data;

    /**
     * Create a new event instance.
     *
     * @param Model $model
     * @param int $action
     * @param mixed $data
     */
    public function __construct(Model $model, int $action, $data = null) {
        //
        $this->model = $model;
        $this->action = $action;
        $this->data = $data;
    }
    /**
     * @return Model
     */
    public function getModel(): Model {
        return $this->model;
    }
    /**
     * @return int
     */
    public function getAction(): int {
        return $this->action;
    }
    /**
     * @return Model
     */
    public function getData(): Model {
        return $this->data;
    }
}
