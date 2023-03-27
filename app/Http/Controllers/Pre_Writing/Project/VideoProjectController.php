<?php

namespace App\Http\Controllers\Pre_Writing\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectVideo;
use Illuminate\Support\Facades\DB;

class VideoProjectController extends Controller
{
    public function store(Request $request, $p_id)
    {
        $pv_video_path = '';
        $pv_file = '';
        if($request->hasFile('video'))
        {
            $video = $request->file('video');
            $extension = $video->getClientOriginalExtension();
            $pv_file = $extension;
            $video_name = time().'.'.$extension;
            $pv_video_path = $video_name;
            $request->video->move(public_path('video'), $video_name);
            $pv_id = DB::table('pv_project_video')->max('pv_id') +1;

            ProjectVideo::create([
                'pv_id' => $pv_id,
                'p_id' => $p_id,
                'pv_title'=> $request->input('title_video'),
                'pv_video_path' => $pv_video_path,
                'pv_mime_type' => $pv_file,
                'created_at'=>now(),
                'updated_at'=>now()
            ]);
        }

    }

    public function show($p_id)
    {
        $video_project = ProjectVideo::where('p_id', $p_id)->first();

        return $video_project;
    }
}
