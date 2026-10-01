<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\Facades\Hash;

#[Signature('hash:encrypt {plain-text : plain text to be encrypted}')]
#[Description('Used for hashing plain text')]
class HashPlainText extends Command implements PromptsForMissingInput
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $plainText = $this->argument('plain-text');
        $hash = Hash::make($plainText);
        $this->info("Encrypt value: $hash");
    }
}
