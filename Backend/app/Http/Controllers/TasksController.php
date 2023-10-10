<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TasksController extends Controller
{
    //
    public function storeTasks(Request $request)
    { {
            $validator = Validator::make(
                $request->only(['title','description']),
                [
                    'title' => 'required|string|max:255|unique:tasks',
                    'description' => 'required|string'
                ]
            );

            $validator->setCustomMessages([
                'title.required' => 'The title field is required.',
                'title.unique' => 'This title  is already exist.',
                'title.max' => 'title max is 255 characters long.',

                'description.required' => 'The description field is required.',
            ]); 

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }

             $task = Tasks::create([
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => $request->user()->id
            ]);

            return response()->json(['message' => 'Task Enregistred successfully'], 201); 
        }
    }

    public function getTasks(Request $request){

        $tasks = User::find($request->user()->id)->task;
        return response()->json(['tasks' => $tasks], 200); 

    }

    public function deleteTasks($id){


        $task = Tasks::find($id);
       
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }
    
        $task->delete();
    
        return response()->json(['message' => 'Task deleted successfully'],200);
    }
    public function completeTask($id){

        
        $task = Tasks::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->completed = !$task->completed;
        $task->save();
    
        return response()->json(['message' => 'Task updated successfully'],200);
    }
}