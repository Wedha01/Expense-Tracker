@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 dark:bg-gray-950 py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        
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
            <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-lg p-6 border border-green-100 dark:border-green-900/30 hover:shadow-xl transition-all">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm font-medium text-green-600 dark:text-green-400">Total Income</p>
                        <p class="text-4xl font-bold text-green-600 dark:text-green-400 mt-2">Rp {{ number_format($totalIncome ?? 0) }}</p>
                    </div>
                    <div class="text-5xl">💰</div>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-4">This month</p>
            </div>

            <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-lg p-6 border border-red-100 dark:border-red-900/30 hover:shadow-xl transition-all">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm font-medium text-red-600 dark:text-red-400">Total Expense</p>
                        <p class="text-4xl font-bold text-red-600 dark:text-red-400 mt-2">Rp {{ number_format($totalExpense ?? 0) }}</p>
                    </div>
                    <div class="text-5xl">🛒</div>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-4">This month</p>
            </div>

            <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-lg p-6 border border-blue-100 dark:border-blue-900/30 hover:shadow-xl transition-all">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm font-medium text-blue-600 dark:text-blue-400">Balance</p>
                        <p class="text-4xl font-bold mt-2 {{ ($balance ?? 0) >= 0 ? 'text-blue-600 dark:text-blue-400' : 'text-red-600 dark:text-red-400' }}">
                            Rp {{ number_format($balance ?? 0) }}
                        </p>
                    </div>
                    <div class="text-5xl">📊</div>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-4">This month</p>
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
                    <div class="px-6 py-5 flex justify-between hover:bg-gray-50 dark:hover:bg-gray-800">
                        <div class="flex items-center gap-4">
                            <span class="w-10 h-10 rounded-2xl flex items-center justify-center text-xl"
                                  style="background: {{ $transaction->category->color ?? '#6b7280' }}20; color: {{ $transaction->category->color ?? '#6b7280' }}">
                                {{ $transaction->category->icon ?? '📌' }}
                            </span>
                            <div>
                                <p class="font-medium dark:text-white">{{ $transaction->description }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $transaction->category->name ?? 'Uncategorized' }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold {{ $transaction->type === 'income' ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                {{ $transaction->type === 'income' ? '+' : '-' }} Rp {{ number_format($transaction->amount) }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $transaction->transaction_date->format('d M Y') }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection