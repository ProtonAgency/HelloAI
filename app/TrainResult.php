<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class TrainResult extends Model
{
	use Cachable;

    protected $fillable = [
    	'artifical_intelligence_id', 'index', 'of', 'accuracy',
    ];
}
