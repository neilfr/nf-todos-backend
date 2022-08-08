<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DestroyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Task $task
     * @param Request $request
     */
    public function __invoke(Task $task, Request $request)
    {
        $task->delete();
        return Response::HTTP_OK;
    }
}
