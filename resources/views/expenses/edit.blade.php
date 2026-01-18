@extends('layouts.app')

@section('content')
<h3>Edit Expense</h3>

<form action="{{ route('expenses.update', $expense) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Title</label>
        <input type="text" name="title"
               class="form-control"
               value="{{ old('title', $expense->title) }}">
    </div>

    <div class="mb-3">
        <label>Category</label>
        <input type="text" name="category"
               class="form-control"
               value="{{ old('category', $expense->category) }}">
    </div>

    <div class="mb-3">
        <label>Amount</label>
        <input type="number" step="0.01" name="amount"
               class="form-control"
               value="{{ old('amount', $expense->amount) }}">
    </div>

    <div class="mb-3">
        <label>Date</label>
        <input type="date" name="expense_date"
               class="form-control"
               value="{{ old('expense_date', $expense->expense_date) }}">
    </div>

    <button class="btn btn-success">Update</button>
    <a href="{{ route('expenses.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection
