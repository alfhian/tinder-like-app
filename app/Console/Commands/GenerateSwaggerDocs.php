<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class GenerateSwaggerDocs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * This is the command you will run in Artisan.
     *
     * Example: php artisan swagger:generate
     *
     * @var string
     */
    protected $signature = 'swagger:generate';

    /**
     * The console command description.
     *
     * This text will be shown when you run "php artisan list".
     *
     * @var string
     */
    protected $description = 'Generate Swagger/OpenAPI documentation from annotations';

    /**
     * Execute the console command.
     *
     * This method is called when the command is run.
     *
     * @return void
     */
    public function handle()
    {
        $this->info('Generating Swagger documentation...');

        // Run the built-in L5-Swagger generate command
        $process = new Process(['php', 'artisan', 'l5-swagger:generate']);
        $process->run();

        if ($process->isSuccessful()) {
            $this->info('Swagger docs generated successfully!');
        } else {
            $this->error('Failed to generate Swagger docs.');
            $this->error($process->getErrorOutput());
        }
    }
}
