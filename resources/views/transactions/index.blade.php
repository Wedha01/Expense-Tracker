@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 dark:bg-gray-950 py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">All Transactions</h1>
                <p class="text-gray-600 dark:text-gray-400">Manage your income and expenses</p>
            </div>
            <a href="{{ route('transactions.create') }}" 
               class="mt-4 sm:mt-0 inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl font-medium transition-all">
                <span class="text-xl">+</span> Add New Transaction
            </a>
        </div>

        <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-lg overflow-hidden">
            
            @if($allTransactions->isEmpty())   <!-- Changed from $transactions -->
                <div class="p-16 text-center">
                    <p class="text-6xl mb-4">📭</p>
                    <p class="text-xl text-gray-500 dark:text-gray-400">No transactions found</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Date</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Description</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400">Category</th>
                                <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 dark:text-gray-400">Amount</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($allTransactions as $transaction)   <!-- Changed here too -->
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                                <td class="px-6 py-5 text-sm text-gray-500 dark:text-gray-400">
                                    {{ $transaction->transaction_date->format('d M Y') }}
                                </td>
                                <td class="px-6 py-5">
                                    <p class="font-medium text-gray-900 dark:text-white">
                                        {{ $transaction->description ?? '-' }}
                                    </p>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-2">
                                        <span class="inline-block w-3 h-3 rounded-full" 
                                              style="background-color: {{ $transaction->category->color ?? '#6b7280' }}">
                                        </span>
                                        <span class="text-sm text-gray-600 dark:text-gray-300">
                                            {{ $transaction->category->name ?? 'Uncategorized' }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-5 text-right">
                                    <p class="font-semibold {{ $transaction->type === 'income' ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $transaction->type === 'income' ? '+' : '-' }} 
                                        Rp {{ number_format($transaction->amount, 0) }}
                                    </p>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                    {{ $allTransactions->links() }}   <!-- Changed here -->
                </div>
            @endif
        </div>

    </div>
</div>
@endsection