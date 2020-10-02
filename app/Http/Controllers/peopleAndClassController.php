<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\peopleAndClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class peopleAndClassController extends Controller
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
    public function store(Request $request)
    {
        //

        $classroom = Classroom::find($request->id_class);
        $check = peopleAndClass::all()->where("id_people", Auth::id());

        if ($classroom != null && isEmpty($check) == true) {
            $peopleAndClass = new peopleAndClass();
            $peopleAndClass->id_class = $request->id_class;
            $peopleAndClass->id_people = Auth::id();
            $peopleAndClass->save();
        }
        return redirect()->route('dashboard');
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
        $peopleAndClass = peopleAndClass::all()->where("id_people", Auth::id())->where("id_class", $id);

        if (count($peopleAndClass) == 0) {
            return redirect()->route("dashboard");
        }
        $classroom = Classroom::findOrFail($id);
        $peopleAndClass = peopleAndClass::all()->where("id_class", $id);
        if ($peopleAndClass != null) {

            return view('welcome', ["peopleAndClass" => $peopleAndClass, "classroom" => $classroom, "people" => true]);
        }
        return view('welcome', ["classroom" => $classroom, "stream" => true]);
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        //


        $people = peopleAndClass::all()->where("id_class", $request->id_class)->where("id_people", $id)->first();
        if ($people != null) {
            $people->delete();
        }
        return redirect()->back();
    }
}