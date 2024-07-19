<?php
if (! function_exists('format_rupiah')) {
    /**
     * Format a number as Indonesian Rupiah currency.
     *
     * @param  int|float  $number
     * @return string
     */
    function format_rupiah($number)
    {
        return 'Rp ' . number_format($number, 0, ',', '.');
    }
}
