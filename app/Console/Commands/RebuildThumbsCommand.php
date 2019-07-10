<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Photo;

class RebuildThumbsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cordylus:thumbs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rebuild the thumbnails';

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
     * @return mixed
     */
    public function handle()
    {
        foreach (Photo::all() as $photo) {
            $this->info('Processing ' . $photo->path);
            $photo->deleteThumbnails(false);
            $photo->createThumbnails();
        }
    }
}
