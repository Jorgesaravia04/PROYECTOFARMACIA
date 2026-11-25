<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['sales_id', 'medicines_id', 'amount', 'price_unit', 'subtotal'])]
class DetailSale extends Model
{
    protected $table = 'details';

    protected function casts(): array
    {
        return [
            'amount' => 'integer',
            'price_unit' => 'decimal:2',
            'subtotal' => 'decimal:2',
        ];
    }

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class, 'sales_id');
    }

    public function medicine(): BelongsTo
    {
        return $this->belongsTo(Medicine::class, 'medicines_id');
    }
}
