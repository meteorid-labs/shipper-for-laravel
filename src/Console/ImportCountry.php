<?php

namespace Meteor\Shipper\Console;

use Illuminate\Console\Command;
use Illuminate\Http\Response;
use Meteor\Shipper\Facades\Shipper;
use Meteor\Shipper\Models\Country;

class ImportCountry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shipper:import-country';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import country data from external API';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Importing country...');

        $shipper = Shipper::make();

        $location = $shipper->location();
        $response = $location->getCountries(limit: 10000)->json();

        if ($response['metadata']['http_status_code'] !== Response::HTTP_OK) {
            $this->error('Failed to import country!');

            return Command::FAILURE;
        }

        $this->withProgressBar($response['data'], function ($data) {
            $country = Country::firstOrNew([
                'shipper_id' => $data['id'],
            ]);
            $country->fill($data);
            $country->save();
        });

        $this->newLine();

        $this->info('Country imported successfully!');

        return Command::SUCCESS;
    }
}
