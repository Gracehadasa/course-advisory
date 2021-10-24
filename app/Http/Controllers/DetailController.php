<?php

namespace App\Http\Controllers;

use App\Detail;
use App\Course;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details = Detail::with('course')->get();
        return view('admin.detail.details', compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::all();
        return view('admin.detail.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation

        $this->validate($request, [
            'course_id' => 'required | integer | unique:details',
            'salary' => 'required | integer',
            'field_work' => 'required | string',
            'description' => 'required | string',
            'companies' => 'required | string',
        ]);

        if(Detail::create($request->all())) {
            return redirect()->back()->with('success', "Course detail was added successfully !!");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $details = Detail::find($id);
        return view('admin.detail.update', compact('details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function edit(Detail $detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validation

        $this->validate($request, [
            'salary' => 'required | integer',
            'field_work' => 'required | string',
            'description' => 'required | string',
            'companies' => 'required | string',
        ]);

        $detail = Detail::find($id);
        $detail->salary = $request->salary;
        $detail->description = $request->description;
        $detail->field_work = $request->field_work;
        $detail->companies = $request->companies;
        if($detail->save()) {
            return redirect()->route('detail.index')->with('success', "Course detail was updated successfully !!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detail = Detail::find($id);
        if($detail->delete()) {
            return redirect()->route('detail.index')->with('success', "Course detail was deleted successfully !!");
        }
    }
}
