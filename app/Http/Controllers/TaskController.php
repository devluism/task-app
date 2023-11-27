<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class TaskController extends Controller
{
    private $completed = "1";
    private $pending = "0";

    public function index()
    {
        $tasks = Task::where('user_id', Auth::user()->id)->get();
        return view('task.list', compact('tasks'));
    }

    public function create(Request $request)
    {
        try {
            // Needs validation
            $task = new Task([
                "title"       => $request->input("title"),
                "description" => $request->input("description"),
                "user_id"     => Auth::user()->id,
            ]);
            if ($task->save()) {
                return back()->with('message', 'Task created');
            }
        }
        catch (\Throwable $th) {
            return back()->with('message', 'Error: '.$th->getMessage());
        }
    }

    public function update(Request $request)
    {
        try {
            // Needs validation
            $task = Task::findOrFail($request->id);
            $task->update([
                "title"       => $request->input("title"),
                "description" => $request->input("description"),
            ]);
            return back()->with('message', 'Task updated');
        }
        catch (\Throwable $th) {
            return back()->with('message', 'Error: '.$th->getMessage());
        }
    }

    public function complete($id)
    {
        try {
            $task = Task::findOrFail($id);
            $status = ($task->status == $this->pending) ? $this->completed : $this->pending;
            $task->update(['status' => $status]);
            return back()->with('message', "Task ".($status == $this->completed ? 'completed' : 'set to pending'));
        }
        catch (\Throwable $th) {
            return back()->with('message', 'Error: '.$th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $task = Task::findOrFail($id);
            $task->delete();
            return back()->with('message', 'Task deleted');

        }
        catch (\Throwable $th) {
            return back()->with('message', 'Error: '.$th->getMessage());
        }
    }
}
