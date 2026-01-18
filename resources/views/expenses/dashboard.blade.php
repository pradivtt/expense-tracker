@extends('layouts.app')

@section('content')
<h3>Expense Dashboard</h3>

<form method="GET" class="row g-3 mb-4">
    <div class="col-md-3">
        <label>Year</label>
        <select name="year" class="form-control">
            @for($y = now()->year; $y >= now()->year - 5; $y--)
                <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>
                    {{ $y }}
                </option>
            @endfor
        </select>
    </div>

    <div class="col-md-3">
        <label>Month (Optional)</label>
        <select name="month" class="form-control">
            <option value="">All Months</option>
            @for($m = 1; $m <= 12; $m++)
                <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                    {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                </option>
            @endfor
        </select>
    </div>

    <div class="col-md-3 align-self-end">
        <button class="btn btn-primary">Filter</button>
    </div>
</form>

@if($categories->count())
    <canvas id="expenseChart" height="100"></canvas>
@else
    <div class="alert alert-warning">
        No data available for selected period.
    </div>
@endif

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('expenseChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($categories),
            datasets: [{
                label: 'Total Expense',
                data: @json($totals)
            }]
        }
    });
</script>

@endsection
