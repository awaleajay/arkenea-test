@extends('layout')

@section('content')

<div class="row justify-content-center mt-4">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header text-center">Edit Employee</div>

            <div class="card-body">
                <form method="post" action="{{route('employees.update', $employee->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH') 

                    <div class="form-group row">
                        <label for="employeeName" class="col-md-4 col-form-label text-md-right">Employee Name</label>
                        <div class="col-md-6">
                            <input id="employeeName" type="text" class="form-control @error('employeeName') is-invalid @enderror" name="employeeName" value="{{$employee->employeeName}}">
                            
                            @error('employeeName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="employeeAddress" class="col-md-4 col-form-label text-md-right">Address</label>
                        <div class="col-md-6">
                            <input id="employeeAddress" type="text" class="form-control @error('employeeAddress') is-invalid @enderror" name="employeeAddress" value="{{$employee->employeeAddress}}">
                            
                            @error('employeeAddress')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$employee->email}}">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-md-4 col-form-label text-md-right">Phone</label>
                        <div class="col-md-6">
                            <input id="phone" type="text" class="form-control @error('age') is-invalid @enderror" name="phone" value="{{$employee->phone}}">

                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="DateofBirth" class="col-md-4 col-form-label text-md-right">Date of Birth</label>
                        <div class="col-md-6">
                            <input id="txtDate" type="date" class="date form-control form-control @error('DateofBirth') is-invalid @enderror" name="DateofBirth" value="{{$employee->DateofBirth}}">

                            @error('DateofBirth')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Employee Image" class="col-md-4 col-form-label text-md-right">Employee Image</label>
                        <div class="col-md-6">
                            <input id="employeeImage" type="file" class="date form-control form-control @error('employeeImage') is-invalid @enderror" name="employeeImage" onchange="validateFileType()">
                            <img src="/public/images/{{$employee->employeeImage}}" width="100px"> {{ $employee->employeeImage }}
                            @error('employeeImage')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <a href="{{route('employees.index')}}" class="btn btn-outline-dark">
                                Cancle
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>    
<script type="text/javascript">
   
     $(function(){
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + day;
    $('#txtDate').attr('max', maxDate);
});
function validateFileType(){
        var fileName = document.getElementById("employeeImage").value;
        var idxDot = fileName.lastIndexOf(".") + 1;
        var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
        if (extFile=="jpg" || extFile=="png"){
            //TO DO
        }else{
            alert("Only jpg and png files are allowed!");
            $("#employeeImage").val(null);
        }   
    }
</script> 
@endsection