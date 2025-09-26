<?php

namespace App\Console\Commands;

use App\Models\Project;
use App\Notifications\ProjectDeadlineReminder;
use Illuminate\Console\Command;
use Carbon\Carbon;

class SendDeadlineReminders extends Command
{
    protected $signature = 'app:send-deadline-reminders';
    protected $description = 'Kirim notifikasi pengingat untuk proyek yang akan jatuh tempo';

    public function handle()
    {
        $this->info('Mencari proyek yang akan jatuh tempo...');

        $targetDate = Carbon::now()->addDays(3)->startOfDay();

        $projects = Project::whereDate('due_date', $targetDate)->get();

        if ($projects->isEmpty()) {
            $this->info('Tidak ada proyek yang jatuh tempo dalam 3 hari.');
            return;
        }

        foreach ($projects as $project) {
            // Hindari mengirim notifikasi berulang
            $alreadyNotified = $project->user->notifications()
                ->where('data->project_id', $project->id)
                ->where('created_at', '>', now()->subDays(3))
                ->exists();

            if (!$alreadyNotified) {
                $project->user->notify(new ProjectDeadlineReminder($project));
                $this->info("Notifikasi terkirim untuk proyek: {$project->name}");
            } else {
                $this->info("Notifikasi untuk proyek: {$project->name} sudah pernah dikirim.");
            }
        }

        $this->info('Semua notifikasi pengingat berhasil dikirim.');
    }
}