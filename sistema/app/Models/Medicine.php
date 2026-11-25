<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['category_id', 'amount', 'price_unit', 'subtotal', 'image'])]
class Medicine extends Model
{
    protected function casts(): array
    {
        return [
            'amount' => 'integer',
            'price_unit' => 'decimal:2',
            'subtotal' => 'decimal:2',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
