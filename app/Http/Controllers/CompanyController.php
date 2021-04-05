<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::denies('access'))
            return Redirect::back()->with('error', "No access");
        else{
            return Inertia::render('Company/Index', [
                'companies' => Company::all(),
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('access'))
            return Redirect::back()->with('error', "No access");
        else{
            return Inertia::render('Company/Create',[
                'users' => User::where('role','=', false)->doesntHave('company')->get(),
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        if(Gate::denies('access'))
            return Redirect::back()->with('error',  "No access");
        else{

            Request::validate([
                'name' => ['required', 'min:3'],
                'banner' => ['required', 'min:3'],
                'website' => ['required', 'min:3'],
                'quality1' => ['required', 'min:2'],
                'quality2' => ['required', 'min:2'],
                'quality3' => ['required', 'min:2'],
                'user_id' => ['required'],
                'logo' => ['nullable', 'image', 'max:1024'],
            ]);

            $company = Company::create([
                'name' => Request::get('name'),
                'banner' => Request::get('banner'),
                'website' =>  Request::get('website'),
                'quality1' => Request::get('quality1'),
                'quality2' => Request::get('quality2'),
                'quality3' =>  Request::get('quality3'),
                'user_id' =>  Request::get('user_id'),
            ]);

            if (Request::hasFile('logo')) {
                $photo = Request::file('logo');
                $company->forceFill([
                    'logo' => $photo->storePublicly(
                        'company-photos', ['disk' => 'public']
                    ),
                ])->save();
            }
            return Redirect::route('company.index')->with('success',"Company added");
        }
    }

    public function edit(Company $company)
    {
        if(Gate::denies('access'))
            return Redirect::back()->with('error', "No access");
        else{
            return Inertia::render('Company/Edit', [
                'company' => $company,
                'users' => User::where('role','=', false)->doesntHave('company')->get(),
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Company $company)
    {
        if(Gate::denies('access'))
            return Redirect::back()->with('error',"No access");
        else{
            Request::validate([
                'name' => ['required', 'min:3'],
                'banner' => ['required', 'min:3'],
                'website' => ['required', 'min:3'],
                'quality1' => ['required', 'min:2'],
                'quality2' => ['required', 'min:2'],
                'quality3' => ['required', 'min:2'],
                'user_id' => ['required'],
                'logo' => ['nullable', 'image', 'max:1024'],
            ]);

            $company->update([
                'name' => Request::get('name'),
                'banner' => Request::get('banner'),
                'website' =>  Request::get('website'),
                'quality1' => Request::get('quality1'),
                'quality2' => Request::get('quality2'),
                'quality3' =>  Request::get('quality3'),
                'user_id' =>  Request::get('user_id'),
            ]);

            if (Request::hasFile('logo')) {
                $photo = Request::file('logo');
                Storage::disk('public')->delete($company->photo);

                $company->forceFill([
                    'logo' => $photo->storePublicly(
                        'company-photos', ['disk' => 'public']
                    ),
                ])->save();
            }

            return Redirect::route('company.index')->with('success', "Company edited");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        if(Gate::denies('access'))
            return Redirect::back()->with('error',"No access");
        else{
            $company->employees()->delete();
            $company->delete();
            return Redirect::route('company.index')->with('success', "Company deleted");
        }
    }
}
