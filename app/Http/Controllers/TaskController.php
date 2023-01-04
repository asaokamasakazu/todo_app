<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // indexアクション以外をログイン必須に設定
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $tasks = Auth::user()->tasks;
        } else {
            $tasks = "";
        }
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $today = date("Y-m-d");
        return view('tasks.create', compact('today'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Task::$rules);
        $task = new Task;
        $form = $request->all() + ['user_id' => Auth::id()];
        unset($form['_token']);
        $task->fill($form)->save();
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);

        if (auth()->id() != $task->user_id) {
            return redirect('/');
        }

        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        $today = date("Y-m-d");

        if (auth()->id() != $task->user_id) {
            return redirect('/');
        }

        return view('tasks.edit', compact('task', 'today'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        if (auth()->id() != $task->user_id) {
            return redirect('/');
        }

        $this->validate($request, Task::$rules);
        $form = $request->all();
        unset($form['_token']);
        $task->fill($form)->save();
        return redirect()->route('tasks.show', $task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);

        if (auth()->id() != $task->user_id) {
            return redirect('/');
        }

        $task->delete();
        return redirect('/');
    }
}
