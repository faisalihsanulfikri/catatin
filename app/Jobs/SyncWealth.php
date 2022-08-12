<?php

namespace App\Jobs;

use App\Facades\PriceScrape;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use Illuminate\Support\Facades\DB;

use App\Models\Income;
use App\Models\Expenditure;
use App\Models\Wealth;

class SyncWealth implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $userId;
    
    public function __construct($userId)
    {
      $this->userId = $userId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      $wealth = Wealth::where('user_id', $this->userId)->first();
      if ($wealth) {
        DB::beginTransaction();
        try {
          $wealth->amount = $this->getTotalIncomes() - $this->getTotalExpenditure();
          $wealth->is_process = 0;
          $wealth->process_msg = 'FINISH SyncWealth';
          $wealth->save();
    
          DB::commit();
        } catch (\Throwable $th) {
          DB::rollback();
  
          $error = json_encode([
            'Code' => $th->getCode(),
            'Message' => $th->getMessage(),
            'File' => $th->getFile(),
            'Line' => $th->getLine(),
          ]);
  
          $wealth->is_process = 0;
          $wealth->process_msg = 'FAILED SyncWealth = '.$error;
          $wealth->save();
  
        }
      }
    }

    public function getTotalIncomes()
    {
      $total = Income::selectRaw('SUM(amount) as total_amount')->where('user_id', $this->userId)->first()->total_amount;
      return $total ? $total : 0;
    }
    
    public function getTotalExpenditure()
    {
      $total = Expenditure::selectRaw('SUM(amount) as total_amount')->where('user_id', $this->userId)->first()->total_amount;
      return $total ? $total : 0;
    }
}
