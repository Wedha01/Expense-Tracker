<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // === Dashboard Data ===
        $totalIncome = Transaction::where('user_id', $user->id)
            ->where('type', 'income')
            ->whereMonth('transaction_date', $currentMonth)
            ->whereYear('transaction_date', $currentYear)
            ->sum('amount');

        $totalExpense = Transaction::where('user_id', $user->id)
            ->where('type', 'expense')
            ->whereMonth('transaction_date', $currentMonth)
            ->whereYear('transaction_date', $currentYear)
            ->sum('amount');

        $balance = $totalIncome - $totalExpense;

        $recentTransactions = Transaction::with('category')
            ->where('user_id', $user->id)
            ->orderBy('transaction_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // === All Transactions for Index Page ===
        $allTransactions = Transaction::with('category')
            ->where('user_id', $user->id)
            ->orderBy('transaction_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $categories = Category::where('user_id', $user->id)->get();

        // Check if user is accessing /transactions or /dashboard
        if (request()->routeIs('transactions.index')) {
            return view('transactions.index', compact('allTransactions', 'categories'));
        }

        
        // Default: Dashboard
        return view('dashboard', compact(
            'totalIncome',
            'totalExpense',
            'balance',
            'recentTransactions'
        ));
    }
           public function create()
    {
        $categories = Category::where('user_id', Auth::id())->get();
        
        return view('transactions.create', compact('categories'));
    }

            public function store(Request $request)
    {
        $request->validate([
            'type'              => 'required|in:income,expense',
            'amount'            => 'required|numeric|min:100',
            'description'       => 'required|string|max:255',
            'transaction_date'  => 'required|date',
        ]);

        Transaction::create([
            'user_id'          => Auth::id(),
            'type'             => $request->type,
            'category_id'      => null,           // No category
            'amount'           => $request->amount,
            'description'      => $request->description,
            'transaction_date' => $request->transaction_date,
        ]);

        return redirect()->route('dashboard')
                         ->with('success', '✅ Transaction saved successfully!');
    }
}