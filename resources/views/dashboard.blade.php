@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 dark:bg-gray-950 py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        
        <!-- Header -->
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white">Dashboard</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-1">
                    Welcome back, <span class="font-semibold">{{ Auth::user()->name }}</span>
                </p>
            </div>
            <a href="{{ route('transactions.create') }}" 
               class="mt-4 sm:mt-0 inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-500 text-white px-5 py-3 rounded-2xl font-medium transition-all">
                + Add Transaction
            </a>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
            <!-- Total Income -->
            <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-lg p-6 border border-green-100 dark:border-green-900/30 hover:shadow-xl transition-all">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm font-medium text-green-600 dark:text-green-400">Total Income</p>
                        <p class="text-4xl font-bold text-green-600 dark:text-green-400 mt-2">
                            Rp {{ formatRupiah($totalIncome) }}
                        </p>
                    </div>
                    <div class="text-5xl">💰</div>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-4">This month</p>
            </div>

            <!-- Total Expense -->
            <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-lg p-6 border border-red-100 dark:border-red-900/30 hover:shadow-xl transition-all">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm font-medium text-red-600 dark:text-red-400">Total Expense</p>
                        <p class="text-4xl font-bold text-red-600 dark:text-red-400 mt-2">
                            Rp {{ formatRupiah($totalExpense) }}
                        </p>
                    </div>
                    <div class="text-5xl">🛒</div>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-4">This month</p>
            </div>

            <!-- Balance -->
            <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-lg p-6 border border-blue-100 dark:border-blue-900/30 hover:shadow-xl transition-all">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm font-medium text-blue-600 dark:text-blue-400">Balance</p>
                        <p class="text-4xl font-bold mt-2 {{ ($balance ?? 0) >= 0 ? 'text-blue-600 dark:text-blue-400' : 'text-red-600 dark:text-red-400' }}">
                            Rp {{ formatRupiah($balance) }}
                        </p>
                    </div>
                    <div class="text-5xl">📊</div>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-4">This month</p>
            </div>
        </div>

                <!-- Monthly Trend Chart -->
        <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-lg p-6 mb-10">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-6">Monthly Trend (Last 6 Months)</h2>
            <div class="h-80">
                <canvas id="monthlyChart"></canvas>
            </div>
        </div>
        
        <!-- Recent Transactions -->
        <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-lg overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Recent Transactions</h2>
                <a href="{{ route('transactions.index') }}" class="text-blue-600 dark:text-blue-400 hover:underline">View All →</a>
            </div>

            @if($recentTransactions->isEmpty())
                <div class="p-16 text-center text-gray-500 dark:text-gray-400">
                    No transactions yet. Start adding some!
                </div>
            @else
                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($recentTransactions as $transaction)
                    <div class="px-6 py-5 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-800">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-2xl flex items-center justify-center text-xl bg-gray-100 dark:bg-gray-700">
                                {{ $transaction->type === 'income' ? '💰' : '🛒' }}
                            </div>
                            <div>
                                <p class="font-medium dark:text-white">{{ $transaction->description }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $transaction->transaction_date->format('d M Y') }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <div class="text-right">
                                <p class="font-semibold text-lg {{ $transaction->type === 'income' ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                    {{ $transaction->type === 'income' ? '+' : '-' }} 
                                    Rp {{ formatRupiah($transaction->amount) }}
                                </p>
                            </div>

                            <!-- Delete Button -->
                            <form method="POST" action="{{ route('transactions.destroy', $transaction) }}" 
                                  onsubmit="return confirm('Are you sure you want to delete this transaction?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 p-2">
                                    🗑️
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('monthlyChart');
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json(collect($monthlyData)->pluck('month')),
            datasets: [
                {
                    label: 'Income',
                    data: @json(collect($monthlyData)->pluck('income')),
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    tension: 0.4,
                    borderWidth: 3,
                    fill: true
                },
                {
                    label: 'Expense',
                    data: @json(collect($monthlyData)->pluck('expense')),
                    borderColor: '#ef4444',
                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                    tension: 0.4,
                    borderWidth: 3,
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        // Forces the text label keys to clear solid White and Bold
                        color: '#ffffff',
                        font: { 
                            size: 14,
                            weight: 'bold' 
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        // Forces Y-axis amounts to clear solid White and Bold
                        color: '#ffffff',
                        font: {
                            weight: 'bold'
                        },
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    },
                    grid: {
                        // Subtly adjusts gridlines so they don't overpower the clean text labels
                        color: 'rgba(255, 255, 255, 0.1)'
                    }
                },
                x: {
                    ticks: {
                        // Forces X-axis months to clear solid White and Bold
                        color: '#ffffff',
                        font: {
                            weight: 'bold'
                        }
                    },
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>
@endsection