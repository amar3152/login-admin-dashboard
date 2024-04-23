<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; 

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class EmployeeController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();//Get Current logged User

        $employee = $user->employees()->paginate(5);
        return view('admin.index', ['employee' => $employee]);
    }

    public function create(): View
    {
        return view('employee.create');
    }

    public function store(Request $request): RedirectResponse
    {
        // Validation of inputs
        $validatedData = $request->validate([
            'name' => 'required|string|min:4|max:250',
            'position' => 'required|string',
            'email' => 'required|string|email|unique:employee', // Ensure the table name is correctly referenced
            'mobileno' => 'required|numeric|digits:10', // Ensure mobile number is numeric and matches expected digits
            'image' => 'sometimes|file|image|max:5000',
            'gender' => 'required|in:male,female',
            'password' => 'required|min:6',
        ]);

        if ($request->hasFile('image')) {
            $filename = time() . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('images', $filename, 'public');
            $validatedData['image'] = "/storage/" . $path;
        }

        $validatedData['password'] = bcrypt($request->password); // Encrypt password before saving

        // Assuming you have set up a relationship in your User model to handle Employee creation
        $request->user()->employees()->create($validatedData);

        return redirect()->route('admin.index')->with('success', 'Employee added successfully!');
    }

    public function  show($id):View
    {
        $employee = Employee::find($id);
        return view('employee.show')->with('employee',$employee);
    }
    public function edit($id):View
    {
        $employee = Employee::find($id);
        return view('employee.edit')->with('employee',$employee);
    }
    public function update(Request $request, $id): RedirectResponse
{
    $employee = Employee::find($id);
   

    $request->validate([
        'name' => 'required|string|min:4|max:250',           
        'position' => 'required|string',                    
        'email' => 'required|string|email|unique:employee,email,' . $id, // Note the exclusion of the current record
        'mobileno' => 'required|numeric|digits:10',         
        'image' => 'sometimes|file|image|max:5000',         
        'gender' => 'required|in:male,female'               
    ]);
    $input = $request->all();

    if ($request->hasFile('image')) {
        // Delete old image if it exists
        if ($employee->image && Storage::disk('public')->exists('images/' . $employee->image)) {
            Storage::disk('public')->delete('images/' . $employee->image);
        }

        $filename = time().$request->file('image')->getClientOriginalName();
        $path = $request->file('image')->storeAs('images',$filename,'public');
        $input["image"] = "/storage/".$path;
    }

    $employee->update($input);
    session()->flash('success', 'Employee updated successfully.');
    return redirect('employee');
}


    public function destroy($id):RedirectResponse
    {
        Employee::destroy($id);
        session()->flash('success','Data Deleted Sucessfully');
        return redirect('employee');
    }
      
}
