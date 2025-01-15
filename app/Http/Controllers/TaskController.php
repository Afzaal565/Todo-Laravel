<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $tasks = Task::all();

        return Response(['status' => 'success', 'message' => 'Tasks got successfully', 'data' => TaskResource::collection($tasks)]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request): Response
    {
        $inputs = $request->validated();
        $task = Task::create($inputs);
        return Response(['status' => 'success', 'message' => 'Tasks created successfully', 'data' => new TaskResource($task)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task): Response
    {
        $task->update($request->validated());
        return Response(['status' => 'success', 'message' => 'Tasks updated successfully', 'data' => new TaskResource($task)]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task): Response
    {
        $task->delete();
        return Response(['status' => 'success', 'message' => 'Tasks deleted successfully', 'data' => null]);
    }
}
