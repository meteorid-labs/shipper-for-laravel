<?php

namespace Meteor\Shipper\Console;

use Illuminate\Console\Command;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Meteor\Shipper\Facades\Shipper;
use Meteor\Shipper\Models\Logistic;

class ImportLogistic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shipper:import-logistic';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import logistic data from external API';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Importing logistic data...');

        $sandbox = config('meteor.shipper.sandbox');

        $shipper = Shipper::make();

        if ($sandbox) {
            $shipper->useSandbox();
        }

        $logistic = $shipper->logistic();
        $response = $logistic->list()->json();

        if ($response['metadata']['http_status_code'] !== Response::HTTP_OK) {
            $this->error('Failed to import logistic data!');

            return Command::FAILURE;
        }

        $this->withProgressBar($response['data'], function ($data) {
            $logistic = Logistic::firstOrNew([
                'shipper_id' => $data['logistic']['id'],
            ]);
            $logistic->fill($data['logistic']);
            $logistic->save();

            $logistic->rates()->updateOrCreate([
                'shipper_id' => $data['id'],
            ], Arr::except($data, ['logistic']));
        });

        $this->newLine();

        $this->info('Logistic data imported successfully!');

        return Command::SUCCESS;
    }
}
