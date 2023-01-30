<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function get_all_project()
    {
        $projects = \App\Models\Project::orderBy('id','DESC')->get();

        return response()->json([
            'projects' => $projects
        ],200);
    }
    public function create_projects(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',

        ]);
        $service = new \App\Models\Project();
        $service->title = $request->title;
        $service->description = $request->description;
        $service->link = $request->link;
        $service->photo = $request->photo;
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
