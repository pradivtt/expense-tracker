<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Expenses</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <div class="flex justify-between">
                <a href="{{ route('expenses.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Expense</a>

                <form method="GET" class="flex gap-2">
                    <input type="number" name="year" placeholder="Year" value="{{ $year }}" class="border rounded px-2">
                    <input type="number" name="month" placeholder="Month" value="{{ $month }}" class="border rounded px-2">
                    <button type="submit" class="bg-gray-500 text-white px-2 rounded">Filter</button>
                </form>
            </div>

            @if(session('success'))
            <div class="bg-green-200 p-2 rounded">{{ session('success') }}</div>
            @endif

            <table class="min-w-full bg-white border">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">Title</th>
                        <th class="border px-4 py-2">Category</th>
                        <th class="border px-4 py-2">Amount</th>
                        <th class="border px-4 py-2">Date</th>
                        <th class="border px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($expenses as $expense)
                    <tr>
                        <td class="border px-4 py-2">{{ $expense->title }}</td>
                        <td class="border px-4 py-2">{{ $expense->category }}</td>
                        <td class="border px-4 py-2">{{ $expense->amount }}</td>
                        <td class="border px-4 py-2">{{ $expense->expense_date->format('Y-m-d') }}</td>
                        <td class="border px-4 py-2 flex gap-2">
                            <a href="{{ route('expenses.edit', $expense) }}" class="bg-yellow-400 px-2 py-1 rounded">Edit</a>
                            <form method="POST" action="{{ route('expenses.destroy', $expense) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 px-2 py-1 rounded text-white">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="border px-4 py-2 text-center">No expenses found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $expenses->links() }}
        </div>
    </div>
</x-app-layout>