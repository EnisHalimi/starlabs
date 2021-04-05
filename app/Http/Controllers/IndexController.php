<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard');
    }

    public function getCompaniesAndEmployees()
    {
        $companies = Company::all();
        $employees = Employee::all();
        return ['companies'=> $companies, 'employees'=>$employees];
    }

}
