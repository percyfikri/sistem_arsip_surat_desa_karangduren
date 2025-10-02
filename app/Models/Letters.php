<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letters extends Model
{
    use HasFactory;

    protected $table = 'letters';
    protected $primaryKey = 'letter_id';
    public $incrementing = true;
    protected $keyType = 'int';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nomor_surat',
        'category_id',
        'title',
        'path',
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id', 'category_id');
    }

    // Additional methods for letter-related functionalities can be added here
}
