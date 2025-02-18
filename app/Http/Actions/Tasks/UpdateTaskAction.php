<?php

namespace App\Http\Actions\Tasks;

use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class UpdateTaskAction
{
    public function __invoke(UpdateTaskRequest $request, Task $task): JsonResponse
    {
        $data = $request->validated();
        $task->status = $data['status'];
        $task->save();

        return response()->json($task);
    }
}

?>