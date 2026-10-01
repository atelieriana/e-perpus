<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

#[Signature('uuid:generate {--C|count= : How many times this command will generate UUIDs}')]
#[Description('Used for generate UUID')]
class GenerateUUID extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        if ($this->option('count'))
        {
            for($i = 0; $i < $this->option('count'); $i++)
            {
                $this->info(Str::uuid()->toString());
            }
        }
        else
        {
            $this->info(Str::uuid()->toString());
        }
    }
}
