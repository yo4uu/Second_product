<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;


class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', auth()->id())
                ->orderByRaw("FIELD(priority, '最優先', '高', '中', '低')")
                ->get();
        return view('dashboard', compact('tasks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'priority' => 'required|string|between:1,5',
            'comment' => 'nullable|string|max:1000',
        ]);

        
        $task = new Task();
        $task->title = $validated['title'];
        $task->priority = $validated['priority'];
        $task->comment = $validated['comment'] ?? null;
        $task->user_id = auth()->id();
        $task->save();

        
        return redirect(route('dashboard'));
        // ->with(['tasks'=>$task->get()])
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect(route('dashboard'));
    }
}
