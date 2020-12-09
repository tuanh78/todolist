<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidationRequest;
use Illuminate\Http\Request;
use App\Todo;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use App\Rules\CharacterRule;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $todolist = Todo::get();
        return response([
            'todolist' => $todolist
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidationRequest $request)
    {
        //

        $todo = Todo::create([
            'name' => $request->input('name'),
            'condition' => false
        ]);

        return response([
            'todo' => $todo
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
        $request->validate([
            'name' => 'required|min:5'
        ]);

        $todo = DB::table('todos')
              ->where('id', $id)
              ->update(['name' => $request->name,
                        'condition' => $request->condition]);

        return response([
            'message' => 'Update ' . $id . 'Thanh cong'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $todo = Todo::findOrFail($id);
        $todo->delete();
        DB::statement("ALTER TABLE todos AUTO_INCREMENT = $id;");
        if (!Todo::find($id)) {
            DB::statement("ALTER TABLE todos AUTO_INCREMENT = 1;");
        }
        return response([
            'message' => 'Xoa thanh cong'
        ]);
    }
}
