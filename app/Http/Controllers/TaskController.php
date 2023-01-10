<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\TaskRequest;
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
    public function index (Request $request)
    {
        if (Auth::check()) {
            $keyword = $request->input('keyword');

            // 検索フォームの値の有無に応じて$tasksを分岐
            if (empty($keyword)) {
                $tasks = Task::with('user')->where('user_id', Auth::id())->get()->sortBy('deadline');
            } else {
                $tasks = Task::with('user')->where('user_id', Auth::id())
                    ->where(function ($query) use ($keyword) {
                        $query->where('task_name', 'LIKE', "%{$keyword}%")->orWhere('description', 'LIKE', "%{$keyword}%");
                    })->get()->sortBy('deadline');
            }
        } else {
            $keyword = "";
            $tasks = "";
        }

        return view('tasks.index', compact('tasks', 'keyword'));
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
    public function store(TaskRequest $request)
    {
        $task = new Task;
        $form = $request->all() + ['user_id' => Auth::id()];
        unset($form['_token']);
        $task->fill($form)->save();
        $flashMessage = __('tasks.store_success');
        return redirect('/')->with('successMessage', $flashMessage);
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
            $flashMessage = __('tasks.show_error');
            return redirect('/')->with('errorMessage', $flashMessage);
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
            $flashMessage = __('tasks.edit_error');
            return redirect('/')->with('errorMessage', $flashMessage);
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
    public function update(TaskRequest $request, $id)
    {
        $task = Task::find($id);

        if (auth()->id() != $task->user_id) {
            return redirect('/');
        }

        $form = $request->all();
        unset($form['_token']);
        $task->fill($form)->save();
        $flashMessage = __('tasks.update_success');
        return redirect()->route('tasks.show', $task)->with('successMessage', $flashMessage);
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
        $flashMessage = __('tasks.destroy_success');
        return redirect('/')->with('successMessage', $flashMessage);
    }
}
