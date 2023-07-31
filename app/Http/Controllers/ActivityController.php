<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Http\Controllers\Controller;
use App\Models\PhotoActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function landing(){
        $count = 1;
        return view('crmpages.landing')->with(['count', $count]);
    }

    public function loginPost(Request $request){
        if ($request->name == 'bktscrew') {
            return redirect()->route('activity.index');
            Session::put('login',true);
        } else {
            $count = $request->count + 1;
            $name = $request->name;
            return redirect()->route('crm.landing')->with(['data' => 'error', 'count' => $count, 'name' => $name]);
            Session::forget('login');
        }
        
    }

    public function logoutPost(){
        Session::forget('login');
        return redirect()->route('crm.landing');
    }
    
    public function index()
    {
        $data = Activity::orderBy('activity_time','desc')->get();
        return view('crmpages.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'image|mimes:jpeg,png,jpg',
        ]);

        $data = new Activity;
        $data->activity_title = $request->title;
        $data->activity_time = $request->datetime;
        $data->activity_place = $request->place;
        $data->activity_note = $request->note;
        $img = $request->file('photo');
        $img_file = time()."_".$img->getClientOriginalName();

        // Calling getimagesize() function
        list($width, $height) = getimagesize($img);

        if ($width > $height) {
            if ($width > 800) {
                toast('Image size to large!','warning');
                return redirect()->back()->with(['img' => 'error', 'show' => true])->withInput();
            } else {
                $data->activity_thumb = $img_file;
            }
        } else if($height > $width) {
            if ($height > 800) {
                toast('Image size to large!','warning');
                return redirect()->back()->with(['img' => 'error', 'show' => true])->withInput();
            } else {
                $data->activity_thumb = $img_file;
            }
        } else {
            if ($width > 800) {
                toast('Image size to large!','warning');
                return redirect()->back()->with(['img' => 'error', 'show' => true])->withInput();
            } else {
                $data->activity_thumb = $img_file;
            }
        }
        
        $dir_img = 'img/activity';
        $img->move($dir_img,$img_file);
        $data->save();
        
        toast('Activity successfully added','success');
        return redirect()->back();
    }

    public function addPhoto($id){
        $thumbnail = Activity::where('id',$id)->pluck('activity_thumb');
        $thumbnail = $thumbnail[0];
        $data = Activity::where('id',$id)->get();
        // dd($data);
        $photos = PhotoActivity::where('activity_id',$id)->get();
        return view('crmpages.addphoto', compact('data','id','thumbnail','photos'));
    }

    public function addPhotoStore(Request $request){
        $request->validate([
            'photo' => 'image|mimes:jpeg,png,jpg',
        ]);

        $data = new PhotoActivity;
        $data->activity_id = $request->activity_id;
        $img = $request->file('photo');
        $img_file = time()."_".$img->getClientOriginalName();

        // Calling getimagesize() function
        list($width, $height) = getimagesize($img);

        if ($width > $height) {
            if ($width > 800) {
                toast('Image size to large!','warning');
                return redirect()->back()->with(['img' => 'error']);
            } else {
                $data->photos = $img_file;
            }
        } else if($height > $width) {
            if ($height > 800) {
                toast('Image size to large!','warning');
                return redirect()->back()->with(['img' => 'error']);
            } else {
                $data->photos = $img_file;
            }
        } else {
            if ($width > 800) {
                toast('Image size to large!','warning');
                return redirect()->back()->with(['img' => 'error']);
            } else {
                $data->photos = $img_file;
            }
        }
        
        $dir_img = 'img/activity';
        $img->move($dir_img,$img_file);
        $data->save();
        
        toast('Photo successfully added','success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activity = Activity::where('id',$id)->get();
        $title = $activity->pluck('activity_title');
        $title = $title[0];
        $activity_id = $activity->pluck('id');
        $activity_id = $activity_id[0];
        // dd($activity_id);
        $photos = PhotoActivity::where('activity_id',$activity_id)->get();
        return view('crmpages.activity_show', compact('activity','title','photos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Activity::where('id',$id)->get();
        $title = $data->pluck('activity_title');
        $title = 'Edit '.$title[0];
        return view('crmpages.activity_edit', compact('data','title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function updateAct(Request $request, $id)
    {
        Activity::where('id',$id)->update(
            [
                'activity_title' => $request->title,
                'activity_time' => $request->datetime,
                'activity_place' => $request->place,
                'activity_note' => $request->note,
            ]
        );
        
        toast('Activity has been updated','success');
        return redirect()->route('activity.show',$id);
    }

    public function changeThumbEdit($id){
        $data = Activity::where('id',$id)->get();
        $title = Activity::where('id',$id)->pluck('activity_title');
        $title = 'Change Thumbnail '.$title[0];
        $thumbnail = Activity::where('id',$id)->pluck('activity_thumb');
        $thumbnail = $thumbnail[0];
        return view('crmpages.change_thumb', compact('thumbnail','id','title','data'));
    }

    public function changeThumbUpdate(Request $request, $id){
        $request->validate([
            'photo' => 'image|mimes:jpeg,png,jpg',
        ]);

        $img = $request->file('photo');
        $img_file = time()."_".$img->getClientOriginalName();

        // Calling getimagesize() function
        list($width, $height) = getimagesize($img);

        if ($width > $height) {
            if ($width > 800) {
                toast('Image size to large!','warning');
                return redirect()->back()->with(['img' => 'error']);
            } else {
                $thumb = $img_file;
            }
        } else if($height > $width) {
            if ($height > 800) {
                toast('Image size to large!','warning');
                return redirect()->back()->with(['img' => 'error']);
            } else {
                $thumb = $img_file;
            }
        } else {
            if ($width > 800) {
                toast('Image size to large!','warning');
                return redirect()->back()->with(['img' => 'error']);
            } else {
                $thumb = $img_file;
            }
        }
        
        $dir_img = 'img/activity';
        $img->move($dir_img,$img_file);

        Activity::where('id',$id)->update(
            [
                'activity_thumb' => $thumb,
            ]
        );

        $img_prev = $request->img_prev;
        unlink('img/activity/'.$img_prev);
        
        toast('Thumbnail has been updated','success');
        return redirect()->route('activity.show',$id);
    }

    public function photoDelete($id){
        $img_prev = PhotoActivity::where('id',$id)->pluck('photos');
        $img_prev = $img_prev[0];

        // dd($img_prev);

        PhotoActivity::where('id', $id)->delete();

        unlink('img/activity/'.$img_prev);

        toast('Photo has been deleted','success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        //
    }
}
