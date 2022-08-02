<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['kategori'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['pencarian'] ?? false, function ($query, $pencarian) {
            return $query->where(function ($query) use ($pencarian) {
                $query->where('name', 'like', "%" . $pencarian . "%");
            });
        });

        $query->when($filters['kategori'] ?? false, function ($query, $kategori) {
            return $query->whereHas('kategori', function ($query) use ($kategori) {
                $query->where('kategori_id', $kategori);
            });
        });
    }

    public function kategori()
    {
        return $this->belongsTo(kategori::class);
    }
}
