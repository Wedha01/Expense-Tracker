<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Income Categories
        $incomeCategories = [
            ['name' => 'Salary', 'type' => 'income', 'color' => '#22c55e'],
            ['name' => 'Freelance', 'type' => 'income', 'color' => '#10b981'],
            ['name' => 'Bonus', 'type' => 'income', 'color' => '#4ade80'],
            ['name' => 'Investment', 'type' => 'income', 'color' => '#86efac'],
            ['name' => 'Other Income', 'type' => 'income', 'color' => '#a3e635'],
        ];

        // Expense Categories
        $expenseCategories = [
            ['name' => 'Food & Drink', 'type' => 'expense', 'color' => '#ef4444'],
            ['name' => 'Transportation', 'type' => 'expense', 'color' => '#f97316'],
            ['name' => 'Shopping', 'type' => 'expense', 'color' => '#eab308'],
            ['name' => 'Bills & Utilities', 'type' => 'expense', 'color' => '#3b82f6'],
            ['name' => 'Entertainment', 'type' => 'expense', 'color' => '#8b5cf6'],
            ['name' => 'Health', 'type' => 'expense', 'color' => '#ec4899'],
            ['name' => 'Education', 'type' => 'expense', 'color' => '#14b8a6'],
            ['name' => 'Other Expense', 'type' => 'expense', 'color' => '#6b7280'],
        ];

        // Delete old categories for current user (in case you run seeder multiple times)
        Category::where('user_id', Auth::id() ?? 1)->delete();

        // Create Income Categories
        foreach ($incomeCategories as $cat) {
            Category::create([
                'user_id' => Auth::id() ?? 1,
                'name' => $cat['name'],
                'type' => $cat['type'],
                'color' => $cat['color'],
            ]);
        }

        // Create Expense Categories
        foreach ($expenseCategories as $cat) {
            Category::create([
                'user_id' => Auth::id() ?? 1,
                'name' => $cat['name'],
                'type' => $cat['type'],
                'color' => $cat['color'],
            ]);
        }

        echo "✅ Categories seeded successfully!\n";
    }
}