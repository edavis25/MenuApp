<?php

namespace App\Traits;

trait FormatsPrice
{
    /**
     * Get formatted price for display
     * @return string
     */
    public function formattedPrice()
    {
        return '$' . number_format($this->price / 100, 2);
    }
}