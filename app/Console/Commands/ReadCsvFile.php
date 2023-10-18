<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DateTime;
use carbon\carbon;

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
        $expectedDescription = "Loqbox Homes Limited";
        $expectedAmount = 560.00;
        $dueDate = 4;

        $file = $this->argument('file');
        if(!file_exists($file)){
            $this->error('File does not exists'. $file);
            return;
        }

        $data=[];
        $csvFile=fopen($file,'r');
        if($csvFile !== false){
            while(($row = fgetcsv($csvFile)) !== false){
                $uuid = $row[0];
                $timestamp = strtotime($row[1]);
                $description = $row[2];
                $amount = floatval($row[3]);

                $dayDifference = date('d',$timestamp);
                if( $dayDifference>=30 || $dayDifference<=04){
                    if(abs($expectedAmount-$amount)<=0.01){
                        
                    }
                }

            // print_r(date('d',$timestamp)-$dueDate);
               
print_r($data);
                
            }
            
            
            fclose($csvFile);
        }
        else{
            $this->error("Unable to open the file:" . $file);
        }

    }
}
