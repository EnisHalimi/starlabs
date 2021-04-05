<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function index()
    {
        if(Auth::user()->company == null)
            return Redirect::route('dashboard')->with('error',"No company selected. Ask the website administrator to assign one");
        return Inertia::render('Employee/Index', [
            'filters' =>Request::all('search'),
            'employee' => Employee::orderByName()
                        ->filter(Request::only('search'))
                        ->where('company_id','=',Auth::user()->company->id)
                        ->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->company == null)
            return Redirect::route('dashboard')->with('error',"No company selected. Ask the website administrator to assign one");
        return Inertia::render('Employee/Create',[
            'companyID' => Auth::user()->company->id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        if(Auth::user()->company == null)
            return Redirect::route('dashboard')->with('error',"No company selected. Ask the website administrator to assign one");
        Request::validate([
            'name' => ['required', 'min:3'],
            'occupation' => ['required', 'min:3'],
            'bio' => ['required', 'min:3'],
            'email' => ['required', 'min:2'],
            'social_media' => ['required', 'min:2'],
            'company_id' => ['required'],
            'photo' => ['nullable', 'image', 'max:1024'],
        ]);

        $employee = Employee::create([
            'name' => Request::get('name'),
            'occupation' => Request::get('occupation'),
            'bio' =>  Request::get('bio'),
            'email' => Request::get('email'),
            'social_media' => Request::get('social_media'),
            'company_id' =>  Request::get('company_id'),
        ]);

        if (Request::hasFile('photo')) {
            $photo = Request::file('photo');
            $employee->forceFill([
                'photo' => $photo->storePublicly(
                    'employee-photos', ['disk' => 'public']
                ),
            ])->save();
        }



        return Redirect::route('employee.index')->with('success',"Employee added");
    }

    public function edit(Employee $employee)
    {
        if(Auth::user()->company == null)
            return Redirect::route('dashboard')->with('error',"No company selected. Ask the website administrator to assign one");
        return Inertia::render('Employee/Edit', [
            'employee' => $employee,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Employee $employee)
    {
        if(Auth::user()->company == null)
            return Redirect::route('dashboard')->with('error',"No company selected. Ask the website administrator to assign one");
        Request::validate([
            'name' => ['required', 'min:3'],
            'occupation' => ['required', 'min:3'],
            'bio' => ['required', 'min:3'],
            'email' => ['required', 'min:2'],
            'social_media' => ['required', 'min:2'],
            'company_id' => ['required'],
            'photo' => ['nullable', 'image', 'max:1024'],
        ]);

        $employee->update([
            'name' => Request::get('name'),
            'occupation' => Request::get('occupation'),
            'bio' =>  Request::get('bio'),
            'email' => Request::get('email'),
            'social_media' => Request::get('social_media'),
            'company_id' =>  Request::get('company_id'),
        ]);

        if (Request::hasFile('photo')) {
            $photo = Request::file('photo');
            Storage::disk('public')->delete($employee->photo);

            $employee->forceFill([
                'photo' => $photo->storePublicly(
                    'employee-photos', ['disk' => 'public']
                ),
            ])->save();
        }
        return Redirect::route('employee.index')->with('success', "Employee edited");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        if(Auth::user()->company == null)
            return Redirect::route('dashboard')->with('error',"No company selected. Ask the website administrator to assign one");
        $employee->delete();
        return Redirect::route('employee.index')->with('success', "Employee deleted");
    }
}
