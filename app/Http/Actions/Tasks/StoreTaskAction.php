<?php

namespace App\Http\Actions\Tasks;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class StoreTaskAction
{
    public function __invoke(StoreTaskRequest $request): JsonResponse
    {
        $task = Task::create($request->validated());
        return response()->json($task, 201);
    }
}
