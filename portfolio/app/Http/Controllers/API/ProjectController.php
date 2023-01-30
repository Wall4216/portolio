<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProjectController extends Controller
{
    public function get_all_project()
    {
        $projects = \App\Models\Project::orderBy('id','DESC')->get();

        return response()->json([
            'projects' => $projects
        ],200);
    }
    public function add_project(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',

        ]);
        $project = new \App\Models\Project();
        $project->title = $request->title;
        $project->description = $request->description;
        $project->link = $request->link;
        $project->photo = $request->photo;
        $project->save();
    }

    public  function  update(Request  $request, $id)
    {
        $project = \App\Models\Project::find($id);
        $project->company = $request->company;
        $project->period = $request->period;
        if ($project->photo != $request->photo) {
            $strpos = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $strpos);
            $explode = explode('/', $sub)[1];
            $name = time() . "." . $explode;
            $img = Image::make($request->photo)->resize(700, 500);//intervention package
            $upload_path = public_path() . "/img/upload/";
            $image = $upload_path . $project->photo;
            $img->save($upload_path . $name);
            if (file_exists($image)) {
                @unlink($image);
            } else {
                $name = $project->photo;
            }
            $project->photo = $name;
            $project->save();
        }
    }


}
