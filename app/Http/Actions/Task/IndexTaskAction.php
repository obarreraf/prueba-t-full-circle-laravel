<?php

namespace App\Http\Actions\Task;

use App\Models\Task;
use Illuminate\Http\JsonResponse;

class IndexTaskAction
{
    public function __invoke(): JsonResponse
    {
        return response()->json(Task::all());
    }
}

?>