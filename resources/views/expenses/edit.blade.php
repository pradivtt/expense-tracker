<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">Edit Expense</h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-semibold text-gray-900">Edit Expense</h1>
            <p class="mt-2 text-gray-500">Update the expense information below.</p>
        </div>

        <!-- Card -->
        <div class="bg-white shadow-lg rounded-lg p-8">

            <!-- Validation Errors -->
            @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
                <strong>Please fix the following errors:</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('expenses.update', $expense) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                    <input
                        id="title"
                        name="title"
                        type="text"
                        value="{{ old('title', $expense->title) }}"
                        class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm"
                        placeholder="e.g. Lunch, Fuel">
                </div>

                <!-- Category -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <input
                        id="category"
                        name="category"
                        type="text"
                        value="{{ old('category', $expense->category) }}"
                        class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm"
                        placeholder="e.g. Food, Transport">
                </div>

                <!-- Amount -->
                <div>
                    <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">Amount</label>
                    <input
                        id="amount"
                        name="amount"
                        type="number"
                        step="0.01"
                        value="{{ old('amount', $expense->amount) }}"
                        class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm"
                        placeholder="e.g. 50000">
                </div>

                <!-- Date -->
                <div>
                    <label for="expense_date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                    <input
                        id="expense_date"
                        name="expense_date"
                        type="date"
                        value="{{ old('expense_date', $expense->expense_date->format('Y-m-d')) }}"
                        class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm">
                </div>

                <!-- Actions -->
                <div class="flex justify-end gap-3 mt-4">
                    <a href="{{ route('expenses.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition">
                        Update Expense
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>