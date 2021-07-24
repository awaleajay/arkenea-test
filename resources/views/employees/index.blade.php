@extends('layout')

@section('content')

<form action="{{ route('search') }}" method="GET">
    <input type="text" name="search" required/>
    <button type="submit">Search</button>
</form>
    <div class="row mt-4">
        <div class="col-md-12">
            @if(session()->get('success'))
            <div class="alert alert-success my-3">
                {{ session()->get('success') }}  
            </div>
            @endif

            <a href="{{route('employees.create')}}" class="btn btn-primary mb-4">Add Employee</a>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>Sr.no</td>
                        <td>Employee ID</td>
                        <td>Employee Name</td>
                        <td>Address</td>
                        <td>Email Address</td>
                        <td>Phone</td>
                        <td>DOB</td>
                        <td>Employee Image</td>
                        <td colspan="2">Actions</td>
                    </tr>
                </thead>
                <tbody>

                    @foreach($employees as $employee)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$employee->id}}</td>
                        <td>{{$employee->employeeName}}</td>
                        <td>{{$employee->employeeAddress}}</td>
                        <td>{{$employee->email}}</td>
                        <td>{{$employee->phone}}</td>
                        <td>{{$employee->DateofBirth}}</td>
                        <td><img src="public/images/{{ $employee->employeeImage }}" width="50px"></td>
                       
                        <td><a href="{{ route('employees.edit', $employee->id)}}" class="btn btn-primary">Edit</a></td>
                        <td>
                            <form action="{{ route('employees.destroy', $employee->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- Pagination --}}
            <div class="d-flex justify-content-center">
    {!! $employees->links() !!}
</div>
        </div>
    <div>
@endsection