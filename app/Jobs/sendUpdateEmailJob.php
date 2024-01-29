<?php

namespace App\Jobs;

use App\Mail\RegisterEmail;
use App\Mail\UpdateEmail;
use App\Models\Application;
use Barryvdh\DomPDF\Facade\Pdf;
use HackerESQ\Settings\Facades\Settings;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class sendUpdateEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $aplication_id;
    /**
     * Create a new job instance.
     */
    public function __construct($id)
    {
        $this->aplication_id = $id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        /** @var Application $application */
        $application = Application::query()->findOrFail($this->aplication_id);

        if (filter_var($application->email, FILTER_VALIDATE_EMAIL))
            Mail::to($application->email)->send(new UpdateEmail($application));

    }
}
