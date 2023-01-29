<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function get_all_skill(){
        $skills = Skill::with('service')->orderBy('id', 'DESC')->get();
        return response()->json([
           'skills' => $skills
        ],200);
    }
}