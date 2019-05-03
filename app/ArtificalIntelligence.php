<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtificalIntelligence extends Model
{
    protected $fillable = [
    	'user_id', 'export', 'type', 'name', 'identifier',
    ];

    protected $hidden = [
    	'created_at', 'updated_at', 'user_id', 'export', 'id',
    ];

    public function user()
    {
    	return $this->belongsTo(\App\User::class);
    }
}
