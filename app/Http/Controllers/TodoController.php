<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();

        return view('index', compact('todos'));
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'task' => 'required'
        ], [
            'task.required' => 'Task is required'
        ]);

        Todo::create($data);

        return back();
    }

    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'status' => Rule::in(['active', 'completed'])
        ]);

        $todo->update([
            'status' => $request->input('status')
        ]);

        return back();
    }

    public function delete(Todo $todo)
    {
        $todo->delete();

        return back();
    }
}
