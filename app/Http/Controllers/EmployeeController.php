<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Employee;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
             $employees = Employee::orderBy('id')->paginate(5) ;
   
    return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $employeeData = $request->validate([
            'employeeName' => 'required',
            'employeeAddress' => 'required',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required',
            'DateofBirth' => 'required',
            'employeeImage' => 'required|image|mimes:png,jpg',
        ]);
        if ($image = $request->file('employeeImage')) {
            $destinationPath = 'public/images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $employeeData['employeeImage'] = "$profileImage";
        }
        Employee::create($employeeData);
        return redirect('employees')->with('success', 'Employee create successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);

    return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employeeData = $request->validate([
            'employeeName' => 'required',
            'employeeAddress' => 'required',
            'email' => "required|email|unique:employees,email,$id",
            'phone' => 'required|numeric',
            'DateofBirth' => 'required',
            'employeeImage' => 'required',
            'employeeImage.*' => 'mimes:png,jpg'

        ]);
        $employee = Employee::findOrFail($id);
        $employee->employeeName = $request->employeeName;
        $employee->employeeAddress = $request->employeeAddress;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->DateofBirth = $request->DateofBirth;
        $employee->employeeImage = $request->employeeImage;
        

        if ($image = $request->file('employeeImage')) {
            $destinationPath = 'public/images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $employee['employeeImage'] = "$profileImage";
        }else{
            unset($employee['employeeImage']);
        }

    $employee->save();
    return redirect('employees')
            ->with("success", "Employees' details are updated successfully.");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
    $employee->delete();

    return redirect('employees')->with("success", "Employee deleted successfully.");
    }
    public function search(Request $request){
        $search = $request->input('search');
    
            $employees = Employee::query()
            ->where('employeeName', 'LIKE', "%{$search}%")
            ->paginate(5);
        // Return the search view with the resluts compacted
        if (count($employees ) > 0){
        return view('employees.index', compact('employees'));
        }else{
        return redirect('employees')->with( "success" ,"No Details found. Try to search again !" );	
        }
        	
}
}
