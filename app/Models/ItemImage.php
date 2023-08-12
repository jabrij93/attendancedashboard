<?php

namespace App\Models;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemImage extends Model
{
    use HasFactory;

    public $table = 'item_images';

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
