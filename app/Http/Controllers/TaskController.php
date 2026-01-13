<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET /api/tasks
     */
    public function index()
    {
        return Task::all();
    }

    /**
     * Store a newly created resource in storage.
     * POST /api/tasks
     */
    public function store(Request $request)
    {
        // Валидация данных
        $validated = $request->validate([
            'title' => 'required|string|min:1|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed'
        ]);

        // Создание задачи
        $task = Task::create($validated);

        // Возвращаем созданную задачу с кодом 201 (Created)
        return response()->json($task, 201);
    }

    /**
     * Display the specified resource.
     * GET /api/tasks/{id}
     */
    public function show(string $id)
    {
        // Ищем задачу по ID
        $task = Task::find($id);

        // Если задача не найдена, возвращаем 404
        if (!$task) {
            return response()->json([
                'error' => 'Task not found'
            ], 404);
        }

        return $task;
    }

    /**
     * Update the specified resource in storage.
     * PUT /api/tasks/{id}
     */
    public function update(Request $request, string $id)
    {
        // Ищем задачу по ID
        $task = Task::find($id);

        //Если задача не найдена, возвращаем 404
        if (!$task) {
            return response()->json([
                'error' => 'Task not found'
            ], 404);
        }

        // Валидация данных
        $validated = $request->validate([
            'title' => 'sometimes|required|string|min:1|max:255',
            'description' => 'nullable|string',
            'status' => 'sometimes|required|in:pending,in_progress,completed'
        ]);

        // Обновляем задачу
        $task->update($validated);

        return $task;
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /api/tasks/{id}
     */
    public function destroy(string $id)
    {
        // Ищем задачу по ID
        $task = Task::find($id);

        //Если задача не найдена, возвращаем 404
        if (!$task) {
            return response()->json([
                'error' => 'Task not found'
            ], 404);
        }

        // Удаляем задачу
        $task->delete();

        // Возвращаем пустой ответ с кодом 204 (No content)
        return response()->json(null, 204);
    }
}
