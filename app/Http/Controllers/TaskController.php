<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('task');
    }
    
    public function tasks(Request $request)
    {
        $tasks = Task::orderBy('priority');

        if($request->project && $request->project != '1'){
            $tasks->where('project',$request->project);
        }
        
        $tasks = $tasks->get();

        return response()->json($tasks);
    }

    public function store(Request $request)
    {
        $totalTasks =  Task::count();

        $task = Task::create([
            'name' => $request->name,
            'project' => $request->project,
            'priority' => $totalTasks+1
        ]);

        return response()->json($task);
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        
        $task->update([
            'name' => $request->name,
            'project' => $request->project
        ]);

        return response()->json($task);
    }
    
    public function projectNames()
    {
        $projectNames = Task::get()->pluck('project')->unique()->toArray();

        return response()->json($projectNames);
    }

    public function updateOrder(Request $request)
    {
        $orderedTasks = $request->all();
        $priority = 1;
        foreach($orderedTasks as $task){
            $dbTask = Task::find($task['id']);
            $dbTask->priority = $priority;
            $dbTask->save();
            $priority++;
        }
        return response()->json($orderedTasks);
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id)->delete();

        return response()->json(['message' => 'Task has been deleted']);
    }
}
