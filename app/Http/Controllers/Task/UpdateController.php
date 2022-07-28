<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\UpdateRequest;
use App\Models\Task;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Task $task
     * @param UpdateRequest $request
     * @return void
     */
    public function __invoke(Task $task, UpdateRequest $request)
    {
        $task->update($request->validated());
    }
}
