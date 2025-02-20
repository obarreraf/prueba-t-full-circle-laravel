<?php

namespace App\Http\Controllers;

use App\Http\Actions\Tasks\IndexTaskAction;
use App\Http\Actions\Tasks\StoreTaskAction;
use App\Http\Actions\Tasks\UpdateTaskAction;
use App\Http\Actions\Tasks\DestroyTaskAction;
use App\Http\Actions\Tasks\CompletedTasksLastWeekAction;
use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

/**
 * @OA\Tag(
 *     name="Tasks",
 *     description="Endpoints para la gestión de tareas"
 * )
 */
class TaskController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/tasks",
     *     summary="Obtener todas las tareas",
     *     tags={"Tasks"},
     *     @OA\Response(response=200, description="Task List"),
     *     @OA\Response(response=404, description="No tasks found")
     * )
     */
    public function index(IndexTaskAction $indexTaskAction)
    {
        return $indexTaskAction();
    }

    /**
     * @OA\Post(
     *     path="/api/tasks",
     *     summary="Crear una nueva tarea",
     *     tags={"Tasks"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title"},
     *             @OA\Property(property="title", type="string", example="Nueva tarea"),
     *             @OA\Property(property="description", type="string", example="Descripcion nueva tarea"),
     *             @OA\Property(property="status", type="string", example="pending")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Created Task")
     * )
     */
    public function store(StoreTaskRequest $request, StoreTaskAction $storeTaskAction)
    {
        return $storeTaskAction($request);
    }

    /**
     * @OA\Put(
     *     path="/api/tasks/{task}",
     *     summary="Actualizar una tarea",
     *     tags={"Tasks"},
     *     @OA\Parameter(
     *         name="task",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title"},
     *             @OA\Property(property="status", type="string", example="completed")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Updated Task")
     * )
     */
    public function update(UpdateTaskRequest $request, Task $task, UpdateTaskAction $updateTaskAction)
    {
        return $updateTaskAction($request, $task);
    }

    /**
     * @OA\Delete(
     *     path="/api/tasks/{task}",
     *     summary="Eliminar una tarea",
     *     tags={"Tasks"},
     *     @OA\Parameter(
     *         name="task",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=204, description="Tarea eliminada")
     * )
     */
    public function destroy(Task $task, DestroyTaskAction $destroyTaskAction)
    {
        return $destroyTaskAction($task);
    }

    /**
     * @OA\Get(
     *     path="/api/tasks/completed-last-week",
     *     summary="Obtener todas las tareas completadas de la ultima semana",
     *     tags={"completed-last-week"},
     *     @OA\Response(response=200, description="Lista de tareas"),
     *     @OA\Response(response=404, description="No tasks found")
     * )
     */
    public function completedTasksLastWeek(CompletedTasksLastWeekAction $indexTaskAction)
    {
        return $indexTaskAction();
    }
}
