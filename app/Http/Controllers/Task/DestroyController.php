<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use function Symfony\Component\Console\Style\success;

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
