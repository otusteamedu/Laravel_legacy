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
     * @var Model
     */
    private $oldState;
    /**
     * Create a new event instance.
     *
     * @param Model $model
     * @param int $action
     * @param Model|null $oldState
     */
    public function __construct(Model $model, int $action, Model $oldState = null) {
        //
        $this->model = $model;
        $this->action = $action;
        $this->oldState = $oldState;
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
    public function getOldState(): Model {
        return $this->oldState;
    }
}
