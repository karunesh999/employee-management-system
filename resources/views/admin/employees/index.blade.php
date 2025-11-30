@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Employees</h3>
        <a href="{{ route('admin.employees.create') }}" class="btn btn-primary">Add Employee</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-striped align-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Employee</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Phone</th>
                        <th>Joined</th>
                        <th style="width: 130px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $employee)
                        <tr>
                            <td>{{ $employee->id }}</td>
                            <td>
                                <strong>{{ $employee->name }}</strong>
                            </td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->department ?? '-' }}</td>
                            <td>{{ $employee->phone ?? '-' }}</td>
                            <td>{{ $employee->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('admin.employees.edit', $employee->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                <form action="{{ route('admin.employees.destroy', $employee->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this employee?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Del</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No employees yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $employees->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
