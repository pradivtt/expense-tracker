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


    public function dashboard()
    {
        $userId = auth()->id();

        // Total expense
        $totalExpense = Expense::where('user_id', $userId)->sum('amount');

        // Highest spending day
        $highest = Expense::where('user_id', $userId)
            ->selectRaw('expense_date, SUM(amount) as total')
            ->groupBy('expense_date')
            ->orderByDesc('total')
            ->first();
        $highestDay = $highest->expense_date ?? null;
        $highestAmount = $highest->total ?? null;

        // Top category
        $top = Expense::where('user_id', $userId)
            ->selectRaw('category, SUM(amount) as total')
            ->groupBy('category')
            ->orderByDesc('total')
            ->first();
        $topCategory = $top->category ?? null;
        $topCategoryAmount = $top->total ?? null;

        // Monthly expenses (last 12 months)
        $monthly = Expense::where('user_id', $userId)
            ->selectRaw('MONTH(expense_date) as month, SUM(amount) as total')
            ->where('expense_date', '>=', now()->subMonths(11)->startOfMonth())
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $monthlyLabels = [];
        $monthlyTotals = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyLabels[] = Carbon::create()->month($i)->format('M');
            $monthlyTotals[] = $monthly->firstWhere('month', $i)->total ?? 0;
        }

        // Category breakdown
        $data = Expense::where('user_id', $userId)
            ->selectRaw('category, SUM(amount) as total')
            ->groupBy('category')
            ->get();

        $categories = $data->pluck('category');
        $totals = $data->pluck('total');

        return view('dashboard', compact(
            'totalExpense',
            'highestDay',
            'highestAmount',
            'topCategory',
            'topCategoryAmount',
            'monthlyLabels',
            'monthlyTotals',
            'categories',
            'totals'
        ));
    }
}
