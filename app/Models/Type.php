<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'context'];

    /**
     * Get types for a specific context
     */
    public static function forContext(string $context)
    {
        return self::where('context', $context)->get();
    }
}