<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentModel extends Model
{
    use HasFactory;

    protected $table = 'parents'; // Arahkan ke nama tabel jamak

    protected $fillable = ['name', 'address', 'telegram_id', 'phone'];

    public function students()
    {
        return $this->hasMany(Student::class, 'parent_id');
    }
}