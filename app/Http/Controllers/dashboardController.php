<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\peopleAndClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\Environment\Console;

use function PHPUnit\Framework\isEmpty;

class dashboardController extends Controller
{
    //

    public function index()
    {
        $classroom = Classroom::find($this->getIDClass(Auth::id()));
        return view('dashboard', ['listClassroom' => $classroom]);
    }


    private   function getIDClass($id_people)
    {
        $id_class = [];
        $peopleAndClass = peopleAndClass::all()->where("id_people", $id_people);

        if (empty($peopleAndClass) != true) {
            foreach ($peopleAndClass as $pal) {

                array_push($id_class, $pal->id_class);
            }
        }
        return  $id_class;
    }
}