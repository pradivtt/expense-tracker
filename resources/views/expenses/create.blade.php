@extends('layouts.app')

@section('content')
<h3>Add Expense</h3>

<form action="{{ route('expenses.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Title</label>
        <input type="text" name="title"
               class="form-control @error('title') is-invalid @enderror"
               value="{{ old('title') }}">
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label>Category</label>
        <input type="text" name="category"
               class="form-control @error('category') is-invalid @enderror"
               value="{{ old('category') }}">
        @error('category')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label>Amount</label>
        <input type="number" step="0.01" name="amount"
               class="form-control @error('amount') is-invalid @enderror"
               value="{{ old('amount') }}">
        @error('amount')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label>Date</label>
        <input type="date" name="expense_date"
               class="form-control @error('expense_date') is-invalid @enderror"
               value="{{ old('expense_date') }}">
        @error('expense_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button class="btn btn-success">Save</button>
    <a href="{{ route('expenses.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection
