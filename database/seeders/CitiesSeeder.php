<?php

namespace Database\Seeders;

use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Support\Facades\DB;

class CitiesSeeder extends CsvSeeder
{

    public function __construct()
    {
        $this->table = 'cities';
        $this->csv_delimiter = ';';
        $this->filename = base_path().'/database/seeders/csvs/plz_verzeichnis_v2.csv';
        $this->offset_rows = 1;
        $this->mapping = [
            4 => 'PLZ',
            7 => 'city',
        ];
    }

    public function run()
    {
        // Recommended when importing larger CSVs
		DB::disableQueryLog();

		// Uncomment the below to wipe the table clean before populating
		DB::table($this->table)->truncate();

		parent::run();
    }
}
