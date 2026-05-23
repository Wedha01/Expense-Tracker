@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 dark:bg-gray-950 py-8 px-4">
    <div class="max-w-lg mx-auto">

        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Add New Transaction</h1>
            <p class="text-gray-600 dark:text-gray-400">Simple & easy for daily use</p>
        </div>

        <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-lg p-8">

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-2xl">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('transactions.store') }}">
                @csrf

                <!-- Type -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Type</label>
                    <div class="grid grid-cols-2 gap-4">
                        <button type="button" onclick="selectType('income')" 
                                id="btn-income"
                                class="type-btn py-4 rounded-2xl font-medium border-2 border-green-500 bg-green-50 dark:bg-green-900/30 text-green-600">
                            ➕ Income
                        </button>
                        <button type="button" onclick="selectType('expense')" 
                                id="btn-expense"
                                class="type-btn py-4 rounded-2xl font-medium border-2 border-red-500 bg-red-50 dark:bg-red-900/30 text-red-600">
                            ➖ Expense
                        </button>
                    </div>
                    <input type="hidden" name="type" id="type" value="expense">
                </div>

                <!-- Amount -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Amount (Rp)</label>
                    <input type="text" name="amount" required
                        class="w-full px-4 py-4 rounded-2xl border border-gray-300 dark:border-gray-600 
                                bg-white dark:bg-gray-800 
                                text-gray-900 dark:text-white text-2xl focus:ring-2 focus:ring-blue-500"
                        placeholder="0"
                        onkeyup="this.value = this.value.replace(/[^0-9.]/g, '')">
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
                    <input type="text" name="description" required
                           class="w-full px-4 py-4 rounded-2xl border border-gray-300 dark:border-gray-600 
                                  bg-white dark:bg-gray-800 
                                  text-gray-900 dark:text-white 
                                  placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-500"
                           placeholder="Monthly salary / Grocery shopping / Petrol">
                </div>

                <!-- Date -->
                <div class="mb-8">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Date</label>
                    <input type="date" name="transaction_date" 
                           value="{{ date('Y-m-d') }}"
                           class="w-full px-4 py-4 rounded-2xl border border-gray-300 dark:border-gray-600 
                                  bg-white dark:bg-gray-800 
                                  text-gray-900 dark:text-white 
                                  placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="flex gap-4">
                    <a href="{{ route('dashboard') }}" 
                       class="flex-1 text-center py-4 font-medium text-gray-600 dark:text-gray-400 border border-gray-300 dark:border-gray-600 rounded-2xl hover:bg-gray-50 dark:hover:bg-gray-800">
                        Cancel
                    </a>
                    <button type="submit"
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 rounded-2xl transition">
                        Save Transaction
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function selectType(type) {
    document.getElementById('type').value = type;
    
    document.querySelectorAll('.type-btn').forEach(btn => {
        btn.classList.remove('ring-4', 'ring-offset-2');
    });
    
    if(type === 'income') {
        document.getElementById('btn-income').classList.add('ring-4', 'ring-offset-2');
    } else {
        document.getElementById('btn-expense').classList.add('ring-4', 'ring-offset-2');
    }
}

// Default to expense
selectType('expense');
</script>
@endsection