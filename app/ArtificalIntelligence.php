<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtificalIntelligence extends Model
{
    protected $fillable = [
    	'user_id', 'export', 'type',
    ];

    public function user()
    {
    	return $this->belongsTo(\App\User::class);
    }
}
