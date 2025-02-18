<?php

namespace App\Http\Actions\Tasks;

use App\Models\Task;
use Illuminate\Http\JsonResponse;

class IndexTaskAction
{
    public function __invoke(): JsonResponse
    {
        $tasks = Task::all();

        if ($tasks->isEmpty()) {
            return response()->json(['message' => 'No tasks found'], 404);
        }

        return response()->json($tasks,200);
    }
}
