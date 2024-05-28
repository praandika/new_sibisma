<?php

namespace App\Http\Controllers;

use App\Models\JobVacancy;
use App\Http\Controllers\Controller;
use App\Http\Resources\JobVacancyResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobVacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = JobVacancy::all();
        return view('page', compact('data'));
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
    public function store(Request $req)
    {
        if (strpos($req->qualification, "\n") !== false || strpos($req->qualification, "\r") !== false) {
            // Line break found
            $qualification = str_replace(["\r", "\n"], '<br>', $req->qualification);
        } else {
            // No line break found
            $qualification = $req->qualification;
        }

        $data = new JobVacancy;
        $data->title = $req->title;
        $data->qualification = $qualification;
        $data->jobdesc = $req->jobdesc;
        $data->category = $req->category;
        $data->created_by = Auth::user()->id;
        $data->updated_by = Auth::user()->id;
        $data->save();
        toast('Data job vacancy berhasil disimpan','success');
        return redirect()->route('jobvacancy.index')->with('display', true);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobVacancy  $jobVacancy
     * @return \Illuminate\Http\Response
     */
    public function show(JobVacancy $jobvacancy)
    {
        return view('page', compact('jobvacancy'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobVacancy  $jobVacancy
     * @return \Illuminate\Http\Response
     */
    public function edit(JobVacancy $jobvacancy)
    {
        return view('page', compact('jobvacancy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobVacancy  $jobVacancy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, JobVacancy $jobvacancy)
    {
        if (strpos($req->qualification, "\n") !== false || strpos($req->qualification, "\r") !== false) {
            // Line break found
            $qualification = str_replace(["\r", "\n"], '<br>', $req->qualification);
        } else {
            // No line break found
            $qualification = $req->qualification;
        }

        $data = JobVacancy::find($jobvacancy->id);
        $data->title = $req->title;
        $data->qualification = $qualification;
        $data->jobdesc = $req->jobdesc;
        $data->category = $req->category;
        $data->updated_by = Auth::user()->id;
        $data->update();
        toast('Data job vacancy berhasil diubah','success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobVacancy  $jobVacancy
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobVacancy $jobVacancy)
    {
        //
    }

    public function delete($id){
        JobVacancy::find($id)->delete();
        toast('Data job vacancy terhapus','success');
        return redirect()->back();
    }

    public function sendJob() {
        $data = JobVacancy::all();
        return JobVacancyResource::collection($data);
    }

    public function sendJobCat($cat) {
        $data = JobVacancy::where('category', $cat)->get();
        return JobVacancyResource::collection($data);
    }

    public function sendSearchJob(Request $request) {
        $data =  JobVacancy::where('title', 'like', '%'.$request->search.'%')
        ->get();
        return JobVacancyResource::collection($data);
    }
}
