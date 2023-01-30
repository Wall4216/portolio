<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function get_all_experience()
    {
        $experiences = \App\Models\Experience::orderBy('id','DESC')->get();

        return response()->json([
            'experiences' =>$experiences
        ],200);
    }
    public function create_experience(Request $request)
    {
        $this->validate($request, [
            'company' => 'required',

        ]);
        $service = new \App\Models\Experience();
        $service->company = $request->company;
        $service->period = $request->period;
        $service->position = $request->position;
        $service->save();
    }

    public  function  update(Request  $request, $id)
    {
        $service = \App\Models\Experience::find($id);

        $this->validate($request,[
            'company' => 'required'
        ]);

        $service->company = $request->company;
        $service->period = $request->period;
        $service->position = $request->position;
        $service->save();

    }

    public function   delete(Request $request, $id)
    {
        $service = \App\Models\Experience::findOrFail($id);
        $service->delete();
    }
}
