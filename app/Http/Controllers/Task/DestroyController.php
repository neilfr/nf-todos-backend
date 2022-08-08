<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DestroyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Task $task
     * @param Request $request
     * @return RedirectResponse
     */
    public function __invoke(Task $task, Request $request)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }
}
