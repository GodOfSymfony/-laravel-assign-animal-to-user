<?php

namespace App\Console\Commands;

use AnimalParameters;
use App\Events\Tamagotchi;
use App\Models\AnimalUser;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckAnimalParameters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'g325:check-animals';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check animals parameters';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $animals = AnimalUser::where('alive', 1)->get();
        $decSleep = $decCare = $decHunger = $die = [];
        $properties = ['sleep', 'care', 'hunger'];

        /** @var AnimalUser $animal */
        foreach ($animals as $animal) {
            foreach($properties as $property) {
                $arrName = 'dec' . ucfirst($property);
                if ($animal->canDecrement($property)) {
                    ${$arrName}[] = $animal->id;
                }
            }
        }
        if (count($decSleep) > 0) {
            AnimalParameters::decrementProperties($decSleep, 'sleep');
            event(new Tamagotchi());
            Log::info('sleep time ' . now());
        }
        if (count($decCare) > 0) {
            AnimalParameters::decrementProperties($decCare, 'care');
            event(new Tamagotchi());
            Log::info('care time ' . now());
        }
        if (count($decHunger) > 0) {
            AnimalParameters::decrementProperties($decHunger, 'hunger');
            event(new Tamagotchi());
        }

        $animals = AnimalUser::where('alive', 1)
            ->where(function($query) {
                $query->where('sleep', 0)
                    ->orWhere('hunger', 0)
                    ->orWhere('care', 0);
            })
            ->get();
        /** @var AnimalUser $animal */
        foreach ($animals as $animal) {
            if ($animal->canDie()) {
                $die[] = $animal->id;
            }
        }
        if (count($die) > 0) {
            AnimalParameters::resetAliveAttribute($die);
            event(new Tamagotchi());
            Log::warning('die time: ' . now());
        }

        $this->info('Number of sleep: ' . count($decSleep));
        $this->info("number of care: " . count($decCare));
        $this->info("number of hunger: " . count($decHunger));
        $this->warn("number of die: " . count($die) . "\n");

        return self::SUCCESS;
    }
}
