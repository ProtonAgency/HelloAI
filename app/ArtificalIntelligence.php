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

    public function trainresults()
    {
        return $this->hasMany(\App\TrainResult::class);
    }

    public function train(array $dataset, array $labels, bool $now = false)
    {
        $datasets = array_chunk($dataset, 3);
        $labels = array_chunk($labels, 3);

        // we chunk the arrays to conserve memory and allow large datasets to be used
        // todo: remove `for` loop
        // this will also let users know what parts of the dataset had the best data
        for($i = 0; $i < count($datasets); $i++) { 
            // short statement? $now ? ... : ... ;
            if($now) {
                dispatch(new \App\Jobs\TrainModel($this, $datasets[$i], $labels[$i], $i, count($datasets)));
            }
            else
            {
                dispatch_now(new \App\Jobs\TrainModel($this, $datasets[$i], $labels[$i], $i, count($datasets)));
            }
        }
    }

    public function getTextStatus()
    {
        $latest_train = $this->trainresults()->orderBy('created_at', 'desc')->first();

        $training = $latest_train === null ? false : ($latest_train->index === $latest_train->of);
        if($training)
        {
            return 'Training';
        }
        else
        {
            return 'Idle';
        }
    }

    public function getAccuracy()
    {
        $latest_train = $this->trainresults()->orderBy('created_at', 'desc')->first();

        $accuracy = $latest_train === null ? 0 : ($latest_train->index !== $latest_train->of ? $latest_train->accuracy : 0);
        if($accuracy === 0)
        {
            return 'Not Trained';
        }
        elseif($accuracy === 1)
        {
            return '100%';
        }
        else
        {
            return round((float)$accuracy * 100 ) . '%';
        }
    }
}
