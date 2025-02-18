<?php

namespace App\Http\Actions\Tasks;

use App\Models\Task;
use Illuminate\Http\JsonResponse;

class DestroyTaskAction
{
    public function __invoke(Task $task): JsonResponse
    {
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->delete();
        return response()->json(['message' => 'Task Deleted'], 200);
    }
}
