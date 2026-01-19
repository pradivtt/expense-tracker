<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Insights Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <!-- Total Spent -->
                <div class="bg-white rounded-lg shadow p-4 flex flex-col">
                    <h3 class="text-gray-500 text-sm">Total Spent</h3>
                    <p class="text-2xl font-bold text-green-600">Rp {{ number_format($totalExpense,0,',','.') }}</p>
                </div>

                <!-- Highest Day -->
                <div class="bg-white rounded-lg shadow p-4 flex flex-col">
                    <h3 class="text-gray-500 text-sm">Highest Spending Day</h3>
                    <p class="text-2xl font-bold text-red-600">{{ $highestDay->format('d M Y') ?? '-' }}</p>
                    <p class="text-sm text-gray-400">Rp {{ number_format($highestAmount ?? 0,0,',','.') }}</p>
                </div>

                <!-- Top Category -->
                <div class="bg-white rounded-lg shadow p-4 flex flex-col">
                    <h3 class="text-gray-500 text-sm">Top Category</h3>
                    <p class="text-2xl font-bold text-indigo-600">{{ $topCategory ?? '-' }}</p>
                    <p class="text-sm text-gray-400">Rp {{ number_format($topCategoryAmount ?? 0,0,',','.') }}</p>
                </div>
            </div>

            <!-- Monthly Bar Chart -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-bold mb-4">Monthly Expenses</h3>
                <canvas id="monthlyChart"></canvas>
            </div>

            <!-- Category Breakdown (Doughnut) -->
            <div class="bg-white h-1/2 p-6 rounded-lg shadow">
                <h3 class="text-lg font-bold mb-4">Category Breakdown</h3>
                <canvas id="categoryChart"></canvas>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Monthly Bar Chart
        const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
        const monthlyChart = new Chart(monthlyCtx, {
            type: 'bar',
            data: {
                labels: @json($monthlyLabels), // e.g. ['Jan', 'Feb', ...]
                datasets: [{
                    label: 'Expenses per Month',
                    data: @json($monthlyTotals), // [120000, 350000, ...]
                    backgroundColor: 'rgba(99, 102, 241, 0.7)',
                    borderColor: 'rgba(99, 102, 241, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });

        // Category Doughnut Chart
        // Category Doughnut Chart
        const categoryCtx = document.getElementById('categoryChart').getContext('2d');
        const categoryChart = new Chart(categoryCtx, {
            type: 'doughnut',
            data: {
                labels: @json($categories),
                datasets: [{
                    label: 'Category',
                    data: @json($totals),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)',
                        'rgba(255, 159, 64, 0.6)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true, // Forces the chart to respect the container size
                aspectRatio: 2, // Increase this number to make the chart smaller within its box
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            boxWidth: 12, // Smaller legend icons
                            font: {
                                size: 10
                            } // Smaller legend text
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>