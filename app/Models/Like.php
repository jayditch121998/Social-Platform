<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
  protected $fillable = [
    'user_id',
    'likeable_id',
    'likeable_type'
  ];

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public function likeable()
  {
    return $this->morphTo();
  }
} 