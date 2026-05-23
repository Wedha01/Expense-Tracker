<?php

if (!function_exists('formatRupiah')) {
    /**
     * Format number to Indonesian Rupiah style (1.250.000)
     */
    function formatRupiah($amount)
    {
        return number_format($amount ?? 0, 0, ',', '.');
    }
}