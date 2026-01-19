<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ isset($expense) ? 'Edit' : 'Add' }} Expense</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ isset($expense) ? route('expenses.update', $expense) : route('expenses.store') }}">
                @csrf
                @if(isset($expense))
                    @method('PUT')
                @endif

                <div class="mb-4">
                    <label class="block">Title</label>
                    <input type="text" name="title" value="{{ old('title', $expense->title ?? '') }}" class="border px-2 py-1 w-full">
                    @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block">Category</label>
                    <input type="text" name="category" value="{{ old('category', $expense->category ?? '') }}" class="border px-2 py-1 w-full">
                    @error('category') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block">Amount</label>
                    <input type="number" name="amount" value="{{ old('amount', $expense->amount ?? '') }}" class="border px-2 py-1 w-full">
                    @error('amount') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block">Date</label>
                    <input type="date" name="expense_date" value="{{ old('expense_date', isset($expense) ? $expense->expense_date->format('Y-m-d') : '') }}" class="border px-2 py-1 w-full">
                    @error('expense_date') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">{{ isset($expense) ? 'Update' : 'Add' }}</button>
            </form>
        </div>
    </div>
</x-app-layout>
