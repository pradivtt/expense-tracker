<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth; // <--- Add this


class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->query('year');
        $month = $request->query('month');

        $query = Expense::query();

        // Apply year filter ONLY if selected
        if (!empty($year)) {
            $query->whereYear('expense_date', $year);
        }

        // Apply month filter ONLY if selected
        if (!empty($month)) {
            $query->whereMonth('expense_date', $month);
        }

        $expenses = $query
            ->orderBy('expense_date', 'desc')
            ->paginate(10)
            ->appends($request->query()); // keep filters in pagination

        return view('expenses.index', [
            'expenses' => $expenses,
            'year' => $year,
            'month' => $month,
        ]);
    }


    public function create()
    {
        return view('expenses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
            'category' => 'required',
            'amount' => 'required|numeric|min:1',
            'expense_date' => 'required|date',
        ]);

        Expense::create([
            'title' => $request->title,
            'category' => $request->category,
            'amount' => $request->amount,
            'expense_date' => $request->expense_date,
            'user_id' => Auth::id(), // Assign current logged-in user
        ]);

        return redirect()
            ->route('expenses.index')
            ->with('success', 'Expense added successfully.');
    }

    public function edit(Expense $expense)
    {
        return view('expenses.edit', compact('expense'));
    }

    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'title' => 'required|min:3',
            'category' => 'required',
            'amount' => 'required|numeric|min:1',
            'expense_date' => 'required|date',
        ]);

        $expense->update($request->all());

        return redirect()
            ->route('expenses.index')
            ->with('success', 'Expense updated successfully.');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect()
            ->route('expenses.index')
            ->with('success', 'Expense deleted successfully.');
    }


    public function dashboard(Request $request)
    {
        $year = $request->year ?? now()->year;
        $month = $request->month; // nullable

        $query = Expense::whereYear('expense_date', $year);

        if ($month) {
            $query->whereMonth('expense_date', $month);
        }

        $totalExpense = (clone $query)->sum('amount');

        $data = $query
            ->selectRaw('category, SUM(amount) as total')
            ->groupBy('category')
            ->get();

        $categories = $data->pluck('category');
        $totals = $data->pluck('total');

        return view('dashboard', compact(
            'categories',
            'totals',
            'totalExpense',
            'year',
            'month'
        ));
    }
}
