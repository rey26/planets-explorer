<?php

namespace App\Console\Commands;

use App\Services\SwapiService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class SwapiSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swapi:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'The command syncs Star Wars API resources with local entities';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(SwapiService $swapiService)
    {
        try {
            DB::beginTransaction();
            $swapiService->syncPlanets();
            DB::commit();
            return Command::SUCCESS;
        } catch (Throwable $t) {
            DB::rollBack();
            Log::error($t->getMessage());

            return Command::FAILURE;
        }
    }
}
