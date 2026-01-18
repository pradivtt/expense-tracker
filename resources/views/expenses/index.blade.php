@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Expense List</h3>
    <a href="{{ route('expenses.create') }}" class="btn btn-primary">
        + Add Expense
    </a>
</div>

<form method="GET" class="row g-3 mb-3">
    <div class="col-md-3">
        <label>Year</label>
        <select name="year" class="form-control">
            <option value="">All Years</option>
            @for ($y = now()->year; $y >= now()->year - 5; $y--)
            <option value="{{ $y }}" {{ (string)$year === (string)$y ? 'selected' : '' }}>
                {{ $y }}
            </option>
            @endfor
        </select>
    </div>

    <div class="col-md-3">
        <label>Month</label>
        <select name="month" class="form-control">
            <option value="">All Months</option>
            @for ($m = 1; $m <= 12; $m++)
                <option value="{{ $m }}" {{ (string)$month === (string)$m ? 'selected' : '' }}>
                {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                </option>
                @endfor
        </select>
    </div>

    <div class="col-md-3 align-self-end">
        <button class="btn btn-secondary">Filter</button>
        <a href="{{ route('expenses.index') }}" class="btn btn-outline-secondary">
            Reset
        </a>
    </div>
</form>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Title</th>
            <th>Category</th>
            <th>Amount</th>
            <th>Date</th>
            <th width="180">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($expenses as $expense)
        <tr>
            <td>{{ $expense->title }}</td>
            <td>{{ $expense->category }}</td>
            <td>${{ number_format($expense->amount, 2) }}</td>
            <td>{{ $expense->expense_date }}</td>
            <td>
                <a href="{{ route('expenses.edit', $expense) }}" class="btn btn-warning btn-sm">
                    Edit
                </a>

                <form action="{{ route('expenses.destroy', $expense) }}"
                    method="POST"
                    class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Delete this expense?')">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center">
                No expenses found.
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-3">
    {{ $expenses->links() }}
</div>
@endsection