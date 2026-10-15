<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalEquipment extends Model
{
    use HasFactory;

    protected $table = 'medical_equipment';

    protected $fillable = [
        'code',
        'name',
        'category',
        'brand',
        'model_number',
        'serial_number',
        'stock',
        'price',
        'location',
        'condition',
        'image',
        'description',
        'purchase_date',
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'price' => 'decimal:2',
        'stock' => 'integer',
    ];

    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getImageUrlAttribute()
    {
        if ($this->image && file_exists(public_path('uploads/alkes/' . $this->image))) {
            return asset('uploads/alkes/' . $this->image);
        }
        if ($this->image && str_starts_with($this->image, 'http')) {
            return $this->image;
        }
        return null;
    }

    public function getConditionBadgeClassAttribute()
    {
        return match ($this->condition) {
            'Baik' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
            'Perlu Perbaikan' => 'bg-amber-500/10 text-amber-400 border-amber-500/20',
            'Rusak' => 'bg-rose-500/10 text-rose-400 border-rose-500/20',
            'Kalibrasi' => 'bg-sky-500/10 text-sky-400 border-sky-500/20',
            default => 'bg-slate-500/10 text-slate-400 border-slate-500/20',
        };
    }
}
