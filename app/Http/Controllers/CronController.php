<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\User;
use App\Models\Project;
use App\Models\Returntransaction;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendSubscriptionWillExpireEmail;
use App\Models\Installment;
use App\Models\Transaction;

class CronController extends Controller
{
    // Payment settelment for investors.
    public function profitLoss()
    {
        $projects = Project::with('schedule', 'investments')->whereStatus(1)
                    ->whereHas('investments')
                    ->whereHas('schedule', function($query) {
                        $query->where('return_date', today())->whereStatus(0);
                    })
                    ->get();

        foreach ($projects as $project) {
            foreach ($project->investments as $investment) {

                \DB::beginTransaction();
                try {

                    if (optional($project->schedule)->return_type == 'fixed') {
                        $amount = optional($project->schedule)->amount;
                    } else {
                        $amount = (optional($project->schedule)->amount / 100) * $investment->share;
                    }

                    $user = User::find($investment->user_id);
                    if (optional($project->schedule)->profit_type == 'profit') {
                        $user->wallet = $user->wallet + $amount;
                        $type = 'profit';
                    } else {
                        $user->wallet = $user->wallet - $amount;
                        $type = 'loss';
                    }
                    $user->save();

                    Returntransaction::create([
                        'project_id' => $project->id,
                        'user_id' => $user->id,
                        'amount' => $type == 'profit' ? $amount:'-'.$amount,
                    ]);

                    Transaction::create([
                        'user_id' => $user->id,
                        'amount' => $type == 'profit' ? $amount:'-'.$amount,
                        'reason' => 'Investment '.$type,
                        'type' => $type == 'profit' ? 'credit':'debit',
                        'name' => $user->name,
                        'email' => $user->email,
                    ]);

                    $project->schedule->status = 1;
                    $project->schedule->save();

                    \DB::commit();

                } catch (Throwable $th) {
                    // return false;
                }
            }
        }
        return true;
    }

    // Send email to users before their installment date in 7 days
    public function beforeExpireSevenDay() {
        $installments = Installment::with('user', 'project')->where('next_installment', today()->addDays(7))->get();

        if (config('system.queue.mail')) {
                foreach ($installments as $installment) {
                    Mail::to($installment->user->email)->queue(new SendSubscriptionWillExpireEmail($installment, $installment->user, $installment->project));
                }
        }
        return 1;
    }
}
