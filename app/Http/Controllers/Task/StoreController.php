<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param StoreRequest $request
     * @return TaskResource
     */
    public function __invoke(StoreRequest $request)
    {
        $task = new Task();
        $task->description = $request->description;
        $task->priority = $request->priority;
        $task->stage_id = $request->stage_id;
        $task->save();
        return new TaskResource($task);
    }
}
