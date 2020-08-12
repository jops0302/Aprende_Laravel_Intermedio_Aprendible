<?php

namespace App\Listeners;

use App\Events\ProjectSaved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class OptimazeProjectImage implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ProjectSaved  $event
     * @return void
     */
    public function handle(ProjectSaved $event)
    {
        $image = Image::make(Storage::get($event->project->image))
                ->widen(600)
                ->limitColors(255)
                ->encode();

            Storage::put($event->project->image, (string) $image);
    }
}
