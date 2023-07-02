<?php

namespace App\Http\Controllers;

use App\Models\TodoModel;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = TodoModel::all();
        return  view('todoList.index', [
            'title' => 'Todo List',
            'data' => $todos
        ]);
    }


    public function store(Request $request)
    {
        $todo = new TodoModel;
        $todo->title = $request->input('title');
        $todo->save();

        return response()->json(['success' => true, 'message' => 'Todo created successfully']);
    }

    public function updates(Request $request, $id)
    {


        $todo = TodoModel::find($id);
        $todo->completed = $request->input('completed');
        $todo->save();

    }

    public function destroy($id)
    {
        $todo = TodoModel::find($id);
        $todo->delete();

        return response()->json(['success' => true, 'message' => 'Todo deleted successfully']);
    }
}
