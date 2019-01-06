<?php

namespace App\Console\Commands;

use DB;

use Illuminate\Console\Command;

class antrian extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'antrian:nol';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mengubah Antrian Menjadi 0';

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
       $antrian = DB::table('tb_user')
                ->update(['antrian' => '0']);

    }
}
