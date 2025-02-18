<?php

namespace App\Http\Actions\Tasks;

use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class UpdateTaskAction
{
    public function __invoke(UpdateTaskRequest $request, Task $task): JsonResponse
    {
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $data = $request->validated();
        $task->status = $data['status'];
        $task->save();

        return response()->json($task,200);
    }
}
