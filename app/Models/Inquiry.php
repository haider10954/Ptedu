<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\CssSelector\XPath\Extension\FunctionExtension;

class Inquiry extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'file' => 'array',
    ];

    public function getStudentName()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
