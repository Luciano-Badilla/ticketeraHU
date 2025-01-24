<?php

namespace App\Http\Controllers;

use App\Models\GuideModel;
use Illuminate\Http\Request;

class UserGuideController extends Controller
{
    public function index()
    {
        $completeGuides = GuideModel::where('type', 0)->get();
        $quickGuides = GuideModel::where('type', 1)->get();

        return view('user_guide', ['completeGuides' => $completeGuides, 'quickGuides' => $quickGuides]);
    }

    public function guide($id)
    {
        $guide = GuideModel::find($id);
        return view('guide', ['guide' => $guide]);
    }
}
