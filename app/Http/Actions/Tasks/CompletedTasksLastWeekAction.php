<?php

namespace App\Http\Actions\Tasks;

use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;

class CompletedTasksLastWeekAction
{
    public function __invoke(): JsonResponse
    {
        $tasks = Task::where('status', 'completed')
                     ->where('created_at', '>=', Carbon::now()->subDays(7))
                     ->get();

        return response()->json($tasks);
    }
}