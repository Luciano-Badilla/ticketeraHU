<?php

namespace App\Http\Controllers;

use App\Models\GuideModel;
use Illuminate\Http\Request;

class UserGuideController extends Controller
{
    public function index()
    {
        $guides = GuideModel::all();

        return view('user_guide', ['guides' => $guides]);
    }

    public function guide($id)
    {
        $guide = GuideModel::find($id);
        return view('guide', ['guide' => $guide]);
    }
}
