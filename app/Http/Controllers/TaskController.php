<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'title'=>['required', 'regex:/[А-Яа-яЁёA-Za-z]/u'],
            'category'=>['required'],
            'date_start'=>['required', 'date'],
            'time_start'=>['required'],
            'date_end'=>['required', 'date'],
            'time_end'=>['required'],
            'text'=>['required'],
            'img'=>['required', 'max:500', 'mimes:png,jpg,jpeg']
        ],[
            'title.required'=>'Обязательное поле',
            'title.regex'=>'Поле может содержать только кириллицу и латиницу',
            'category.required'=>'Обязательное поле',
            'date_start.required' => 'Обязательное поле',
            'date_start.date' => 'Тип данных - дата',
            'time_start.required' => 'Обязательное поле',
            'date_end.required' => 'Обязательное поле',
            'date_end.date' => 'Тип данных - дата',
            'time_end.required' => 'Обязательное поле',
            'text.required' => 'Обязательное поле',
            'img.required' => 'Обязательное поле',
            'img.max' => 'Максимальный размер 500кб',
            'img.mimes' => 'Допустимые расширения: png, jpg',
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 400);
        };

        $path_img = '';
        if ($request->file()) {
            $path_img = $request->file('img')->store('/public/img/tasks/');
        }

        $task = new Task();
        $task->user_id = Auth::id();
        $task->title = $request->title;
        $task->category = $request->category;
        $task->date_start = $request->date_start;
        $task->time_start = $request->time_start;
        $task->date_end = $request->date_end;
        $task->time_end = $request->time_end;
        $task->text = $request->text;
        $task->img = '/public/storage/' . $path_img;
        $task->save();

        return response()->json('задача создана', 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        if ($task->status == 'новая') {
            $task->status = 'выполнена';
        } else {
            $task->status = 'новая';
        }
        $task->update();
        return redirect()->route('UserPage');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('UserPage');
    }

    public function filter(Request $request) {
        $query = Task::query()->where('user_id', Auth::id())->get();
        if ($request->filter && $request->filter !== 'все') {
            $query = $query->where('status', $request->filter);
        }
        $tasks = $query;
        return view('user.main', ['tasks'=>$tasks]);
    }
}
