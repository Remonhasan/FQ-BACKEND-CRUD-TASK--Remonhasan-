<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
  protected $fillable = ['title', 'description', 'giveback'];

 public function creator()
 {
     return $this->belongsTo(User::class, 'user_id', 'id');
 }
}
