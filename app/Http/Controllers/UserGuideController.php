<?php

namespace App\Http\Controllers;

use App\Models\GuideModel;
use Illuminate\Http\Request;

class UserGuideController extends Controller
{
    public function index()
    {
        if (Auth()) {
            $completeGuides = GuideModel::where('type', 0)->where('admin', 0)->get();
            $quickGuides = GuideModel::where('type', 1)->where('admin', 0)->get();

            $completeGuidesAdmin = GuideModel::where('type', 0)->where('admin', 1)->get();
            $quickGuidesAdmin = GuideModel::where('type', 1)->where('admin', 1)->get();
        } else {
            $completeGuides = GuideModel::where('type', 0)->get();
            $quickGuides = GuideModel::where('type', 1)->get();
            
        }


        return view('user_guide', ['completeGuides' => $completeGuides, 'quickGuides' => $quickGuides, 'completeGuidesAdmin' => $completeGuidesAdmin, 'quickGuidesAdmin' => $quickGuidesAdmin]);
    }

    public function guide($id)
    {
        $guide = GuideModel::find($id);
        return view('guide', ['guide' => $guide]);
    }
}
