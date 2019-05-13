<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\ArtificialIntellegence;

class TrainModel implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**@var ArtificialIntellegence*/
    protected $model;

    /**@var array*/
    protected $dataset;

    /**@var array*/
    protected $labels;

    /**@var int*/
    protected $index;

    /**@var int*/
    protected $index_of;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ArtificialIntellegence $model, array $dataset, array $labels, int $index, int $index_of)
    {
        $this->model = $model;
        $this->dataset = $dataset;
        $this->labels = $labels;
        $this->index = $index;
        $this->index_of = $index_of;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $svc = null;
        if($this->model->export !== null)
        {
            $svc = unserialize($this->model->export, [\Phpml\Estimator::class]);
        }

        $type = '\App\Analysis\\' . str_replace(' ', '', ucwords(strtr($this->model->type, '_', ' ')));
        $trainer = new $type($this->dataset, $this->labels, $svc);
        $accuracy = $trainer->train();

        $this->model->export = $trainer->export();
        $this->model->save();

        // todo: something other than this, it needs to be rewritten
        TrainResult::create([
            'artifical_intelligence_id' => $this->model->id,
            'index' => $this->index,
            'of' => $this->index_of,
            'accuracy' => $accuracy,
        ]);
    }
}
