<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $todos = Todo::where('is_deleted', false)->get();
            $deleted_todos = Todo::where('is_deleted', true)->get();
            return view('index', compact('todos', 'deleted_todos'));
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $todo = Todo::create([
                'title' => $request->title,
                'description' => $request->description
            ]);

            if ($todo) {
                return redirect()->route('todos.index')->with('success', 'Todo list created successfully!');
            }
            return back()->with('error', 'Unable to create todo. Please try again.');
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        return view('show', compact('todo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        return view('edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        try {
            $todo['title'] = $request->title;
            $todo['description'] = $request->description;
            $todo['is_completed'] = $request->completed;
            $todo->save();
            return redirect()->route('todos.index')->with('success', 'Todo list updated successfully!');

        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        try {
            if ($todo) {
                $todo['is_deleted'] = true;
                $todo->save();
                return redirect()->route('todos.index')->with('success', 'Todo list deleted successfully!');
            }
            return back()->with('error', 'Todo list not found!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function restore(Request $request, Todo $todo)
    {
        try {
            if ($todo) {
                $todo['is_deleted'] = false;
                $todo->save();
                return redirect()->route('todos.index')->with('success', 'Todo list deleted successfully!');
            }
            return back()->with('error', 'Todo list not found!');
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
