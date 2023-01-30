<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Edu extends Controller
{
    public function get_all_education()
    {
        $educations = \App\Models\Edu::orderBy('id','DESC')->get();

        return response()->json([
            'educations' =>$educations
        ],200);
    }
    public function create_education(Request $request)
    {
        $this->validate($request, [
           'institution' => 'required',

        ]);
        $service = new \App\Models\Edu();
        $service->institution = $request->institution;
        $service->period = $request->period;
        $service->degree = $request->degree;
        $service->department = $request->department;
        $service->save();
    }

    public  function  update(Request  $request, $id)
    {
        $service = \App\Models\Edu::find($id);

        $this->validate($request,[
            'institution' => 'required'
        ]);

        $service->institution = $request->institution;
        $service->period = $request->period;
        $service->degree = $request->degree;
        $service->department = $request->department;
        $service->save();

    }

    public function   delete(Request $request, $id)
    {
        $service = \App\Models\Edu::findOrFail($id);
        $service->delete();
    }
}
