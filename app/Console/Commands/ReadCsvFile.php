<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ReadCsvFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'read:csv {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reads a csv file and matchs rent transactions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $file = $this->argument('file');
        if(!file_exists($file)){
            $this->error('File does not exists'. $file);
            return;
        }

        $csvdata=[];
        $csvFile=fopen($file,'r');
        if($csvFile !== false){
            while(($row = fgetcsv($csvFile)) !== false){
                $csvdata[]= $row;
                print_r($csvdata);
            }
            fclose($csvFile);
        }
        else{
            $this->error("Unable to open the file:" . $file);
        }
    }
}
