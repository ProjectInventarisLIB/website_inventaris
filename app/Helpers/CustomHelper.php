<?php
 use Carbon\Carbon;
use Carbon\CarbonPeriod;

if (! function_exists('custom_function')) {
    function findEndDate($startDate, $numWorkDays) {
        // Set zona waktu ke Waktu Indonesia Barat (WIB)
        date_default_timezone_set('Asia/Jakarta');
        
        $currentDate = new DateTime($startDate); // Menginisialisasi tanggal awal
        $countWorkDays = 0; // Variabel untuk menghitung jumlah hari kerja
        
        // Iterasi sampai jumlah hari kerja mencapai numWorkDays
        while ($countWorkDays < $numWorkDays) {
            // Tambah 1 hari ke tanggal saat ini
            $currentDate->modify('+1 day');
            
            // Periksa apakah hari ini bukan Sabtu (6) atau Minggu (7)
            if ($currentDate->format('N') < 6) {
                $countWorkDays++; // Jika hari kerja, tambahkan ke jumlah hari kerja
            }
        }
        
        return $currentDate->format('Y-m-d'); // Kembalikan tanggal akhir cuti
    }
    
  
}

if (! function_exists('another_helper_function')) {
    // use Carbon\Carbon;

     function calculateWorkingDaysDifference($startDate, $endDate)
    {
        // Konversi tanggal ke objek Carbon
        $carbonStartDate = Carbon::parse($startDate);
        $carbonEndDate = Carbon::parse($endDate);
    
        // Hitung selisih hari dengan menggunakan diffInDays
        $days_difference = $carbonStartDate->diffInDays($carbonEndDate);
    
        // Iterasi untuk menghitung hari Sabtu dan Minggu di antara dua tanggal
        $weekend_count = -1;
        for ($i = 0; $i <= $days_difference; $i++) {
            $current_day = $carbonStartDate->copy()->addDays($i)->dayOfWeek;
            // Jika hari adalah Sabtu (6) atau Minggu (0), tambahkan ke count weekend
            if ($current_day == Carbon::SATURDAY || $current_day == Carbon::SUNDAY) {
                $weekend_count++;
            }
        }
    
        // Kurangi hari weekend dari selisih hari
        $working_days_difference = $days_difference - $weekend_count;
    
        return $working_days_difference;
    }


    function hitung_pph21($kategori, $result_nominal){
        $pph21 = 0;

    if ($kategori == 'A') {

        if ($result_nominal >= 0 && $result_nominal < 5400000 ) {
            $pph21 = 0;
        } elseif($result_nominal >= 5400000 && $result_nominal < 5650000 ) {
            $pph21 = 0.25;
        } elseif($result_nominal >= 5650000 && $result_nominal < 5950000 ) {
            $pph21 = 0.50;
        } elseif($result_nominal >= 5950000 && $result_nominal < 6300000 ) {
            $pph21 = 0.75;
        } elseif($result_nominal >= 6300000 && $result_nominal < 6750000 ) {
            $pph21 = 1;
        } elseif($result_nominal >= 6750000 && $result_nominal < 7500000 ) {
            $pph21 = 1.25;
        } elseif($result_nominal >= 7500000 && $result_nominal < 8550000 ) {
            $pph21 = 1.50;
        } elseif($result_nominal >= 8550000 && $result_nominal < 9650000 ) {
            $pph21 = 1.75;
        } elseif($result_nominal >= 9650000 && $result_nominal < 10050000 ) {
            $pph21 = 2;
        } elseif($result_nominal >= 10050000 && $result_nominal < 10350000 ) {
            $pph21 = 2.25;
        } elseif($result_nominal >= 10350000 && $result_nominal < 10700000 ) {
            $pph21 = 2.50;
        } elseif($result_nominal >= 10700000 && $result_nominal < 11050000 ) {
            $pph21 = 3;
        } elseif($result_nominal >= 11050000 && $result_nominal < 11600000 ) {
            $pph21 = 3.50;
        } elseif($result_nominal >= 11600000 && $result_nominal < 12500000 ) {
            $pph21 = 4;
        } elseif($result_nominal >= 12500000 && $result_nominal < 13750000 ) {
            $pph21 = 5;
        } elseif($result_nominal >= 13750000 && $result_nominal < 15100000 ) {
            $pph21 = 6;
        } elseif($result_nominal >= 15100000 && $result_nominal < 16950000 ) {
            $pph21 = 7;
        } elseif($result_nominal >= 16950000 && $result_nominal < 19750000 ) {
            $pph21 = 8;
        } elseif($result_nominal >= 19750000 && $result_nominal < 24150000 ) {
            $pph21 = 9;
        } elseif($result_nominal >= 24150000 && $result_nominal < 26450000 ) {
            $pph21 = 10;
        } elseif($result_nominal >= 26450000 && $result_nominal < 28000000 ) {
            $pph21 = 11;
        } elseif($result_nominal >= 28000000 && $result_nominal < 30050000 ) {
            $pph21 = 12;
        } elseif($result_nominal >= 30050000 && $result_nominal < 32400000 ) {
            $pph21 = 13;
        } elseif($result_nominal >= 32400000 && $result_nominal < 35400000 ) {
            $pph21 = 14;
        } elseif($result_nominal >= 35400000 && $result_nominal < 39100000 ) {
            $pph21 = 15;
        } elseif($result_nominal >= 39100000 && $result_nominal < 43850000 ) {
            $pph21 = 16;
        } elseif($result_nominal >= 43850000 && $result_nominal < 47800000 ) {
            $pph21 = 17;
        } elseif($result_nominal >= 47800000 && $result_nominal < 51400000 ) {
            $pph21 = 18;
        } elseif($result_nominal >= 51400000 && $result_nominal < 56300000 ) {
            $pph21 = 19;
        } elseif($result_nominal >= 56300000 && $result_nominal < 62200000 ) {
            $pph21 = 20;
        } elseif($result_nominal >= 62200000 && $result_nominal < 68600000 ) {
            $pph21 = 21;
        } elseif($result_nominal >= 68600000 && $result_nominal < 77500000 ) {
            $pph21 = 22;
        } elseif($result_nominal >= 77500000 && $result_nominal < 89000000 ) {
            $pph21 = 23;
        } elseif($result_nominal >= 89000000 && $result_nominal < 103000000 ) {
            $pph21 = 24;
        } elseif($result_nominal >= 103000000 && $result_nominal < 125000000 ) {
            $pph21 = 25;
        } elseif($result_nominal >= 125000000 && $result_nominal < 157000000 ) {
            $pph21 = 26;
        } elseif($result_nominal >= 157000000 && $result_nominal < 206000000 ) {
            $pph21 = 27;
        } elseif($result_nominal >= 206000000 && $result_nominal < 337000000 ) {
            $pph21 = 28;
        } elseif($result_nominal >= 337000000 && $result_nominal < 454000000 ) {
            $pph21 = 29;
        } elseif($result_nominal >= 454000000 && $result_nominal < 550000000 ) {
            $pph21 = 30;
        } elseif($result_nominal >= 550000000 && $result_nominal < 695000000 ) {
            $pph21 = 31;
        } elseif($result_nominal >= 695000000 && $result_nominal < 910000000 ) {
            $pph21 = 32;
        } elseif($result_nominal >= 910000000 && $result_nominal < 1400000000 ) {
            $pph21 = 33;
        } elseif($result_nominal >= 1400000000  ) {
            $pph21 = 34;
        }
        
        }  elseif ($kategori == 'B') {
       
            if ($result_nominal >= 0 && $result_nominal < 6200000 ) {
            $pph21 = 0;
        } elseif($result_nominal >= 6200000 && $result_nominal < 6500000 ) {
            $pph21 = 0.25;
        } elseif($result_nominal >= 6500000 && $result_nominal < 6850000 ) {
            $pph21 = 0.50;
        } elseif($result_nominal >= 6850000 && $result_nominal < 7300000 ) {
            $pph21 = 0.75;
        } elseif($result_nominal >= 7300000 && $result_nominal < 9200000 ) {
            $pph21 = 1;
        } elseif($result_nominal >= 9200000 && $result_nominal < 10750000 ) {
            $pph21 = 1.50;
        } elseif($result_nominal >= 10750000 && $result_nominal < 11250000 ) {
            $pph21 = 2;
        } elseif($result_nominal >= 11250000 && $result_nominal < 11600000 ) {
            $pph21 = 2.5;
        } elseif($result_nominal >= 11600000 && $result_nominal < 12600000 ) {
            $pph21 = 3;
        } elseif($result_nominal >= 12600000 && $result_nominal < 13600000 ) {
            $pph21 = 4;
        } elseif($result_nominal >= 13600000 && $result_nominal < 14950000 ) {
            $pph21 = 5;
        } elseif($result_nominal >= 14950000 && $result_nominal < 16400000 ) {
            $pph21 = 6;
        } elseif($result_nominal >= 16400000 && $result_nominal < 18450000 ) {
            $pph21 = 7;
        } elseif($result_nominal >= 18450000 && $result_nominal < 21850000 ) {
            $pph21 = 8;
        } elseif($result_nominal >= 21850000 && $result_nominal < 26000000 ) {
            $pph21 = 9;
        } elseif($result_nominal >= 26000000 && $result_nominal < 27700000 ) {
            $pph21 = 10;
        } elseif($result_nominal >= 27700000 && $result_nominal < 29350000 ) {
            $pph21 = 11;
        } elseif($result_nominal >= 29350000 && $result_nominal < 31450000 ) {
            $pph21 = 12;
        } elseif($result_nominal >= 31450000 && $result_nominal < 33950000 ) {
            $pph21 = 13;
        } elseif($result_nominal >= 33950000 && $result_nominal < 37100000 ) {
            $pph21 = 14;
        } elseif($result_nominal >= 37100000 && $result_nominal < 41100000 ) {
            $pph21 = 15;
        } elseif($result_nominal >= 41100000 && $result_nominal < 45800000 ) {
            $pph21 = 16;
        } elseif($result_nominal >= 45800000 && $result_nominal < 49500000 ) {
            $pph21 = 17;
        } elseif($result_nominal >= 49500000 && $result_nominal < 53800000 ) {
            $pph21 = 18;
        } elseif($result_nominal >= 53800000 && $result_nominal < 58500000 ) {
            $pph21 = 19;
        } elseif($result_nominal >= 58500000 && $result_nominal < 64000000 ) {
            $pph21 = 20;
        } elseif($result_nominal >= 64000000 && $result_nominal < 71000000 ) {
            $pph21 = 21;
        } elseif($result_nominal >= 71000000 && $result_nominal < 80000000 ) {
            $pph21 = 22;
        } elseif($result_nominal >= 80000000 && $result_nominal < 93000000 ) {
            $pph21 = 23;
        } elseif($result_nominal >= 93000000 && $result_nominal < 109000000 ) {
            $pph21 = 24;
        } elseif($result_nominal >= 109000000 && $result_nominal < 129000000 ) {
            $pph21 = 25;
        } elseif($result_nominal >= 129000000 && $result_nominal < 163000000 ) {
            $pph21 = 26;
        } elseif($result_nominal >= 163000000 && $result_nominal < 211000000 ) {
            $pph21 = 27;
        } elseif($result_nominal >= 211000000 && $result_nominal < 374000000 ) {
            $pph21 = 28;
        } elseif($result_nominal >= 374000000 && $result_nominal < 459000000 ) {
            $pph21 = 29;
        } elseif($result_nominal >= 459000000 && $result_nominal < 555000000 ) {
            $pph21 = 30;
        } elseif($result_nominal >= 555000000 && $result_nominal < 704000000 ) {
            $pph21 = 31;
        } elseif($result_nominal >= 704000000 && $result_nominal < 957000000 ) {
            $pph21 = 32;
        } elseif($result_nominal >= 957000000 && $result_nominal < 1405000000 ) {
            $pph21 = 33;
        } elseif($result_nominal >= 1405000000  ) {
            $pph21 = 34;
        } 
    
    } elseif ($kategori == 'C') {
    
        if ($result_nominal >= 0 && $result_nominal < 6600000 ) {
            $pph21 = 0;
        } elseif($result_nominal >= 6600000 && $result_nominal < 6950000 ) {
            $pph21 = 0.25;
        } elseif($result_nominal >= 6950000 && $result_nominal < 7350000 ) {
            $pph21 = 0.50;
        } elseif($result_nominal >= 7350000 && $result_nominal < 7800000 ) {
            $pph21 = 0.75;
        } elseif($result_nominal >= 7800000 && $result_nominal < 8850000 ) {
            $pph21 = 1;
        } elseif($result_nominal >= 8850000 && $result_nominal < 9800000 ) {
            $pph21 = 1.25;
        } elseif($result_nominal >= 9800000 && $result_nominal < 10950000 ) {
            $pph21 = 1.50;
        } elseif($result_nominal >= 10950000 && $result_nominal < 11200000 ) {
            $pph21 = 1.75;
        } elseif($result_nominal >= 11200000 && $result_nominal < 12050000 ) {
            $pph21 = 2;
        } elseif($result_nominal >= 12050000 && $result_nominal < 12950000 ) {
            $pph21 = 3;
        } elseif($result_nominal >= 12950000 && $result_nominal < 14150000 ) {
            $pph21 = 4;
        } elseif($result_nominal >= 14150000 && $result_nominal < 15500000 ) {
            $pph21 = 5;
        } elseif($result_nominal >= 15500000 && $result_nominal < 17050000 ) {
            $pph21 = 6;
        } elseif($result_nominal >= 17050000 && $result_nominal < 19500000 ) {
            $pph21 = 7;
        } elseif($result_nominal >= 19500000 && $result_nominal < 22700000 ) {
            $pph21 = 8;
        } elseif($result_nominal >= 22700000 && $result_nominal < 26600000 ) {
            $pph21 = 9;
        } elseif($result_nominal >= 26600000 && $result_nominal < 28100000 ) {
            $pph21 = 10;
        } elseif($result_nominal >= 28100000 && $result_nominal < 30100000 ) {
            $pph21 = 11;
        } elseif($result_nominal >= 30100000 && $result_nominal < 32600000 ) {
            $pph21 = 12;
        } elseif($result_nominal >= 32600000 && $result_nominal < 35400000 ) {
            $pph21 = 13;
        } elseif($result_nominal >= 35400000 && $result_nominal < 38900000 ) {
            $pph21 = 14;
        } elseif($result_nominal >= 38900000 && $result_nominal < 43000000 ) {
            $pph21 = 15;
        } elseif($result_nominal >= 43000000 && $result_nominal < 47400000 ) {
            $pph21 = 16;
        } elseif($result_nominal >= 47400000 && $result_nominal < 51200000 ) {
            $pph21 = 17;
        } elseif($result_nominal >= 51200000 && $result_nominal < 55800000 ) {
            $pph21 = 18;
        } elseif($result_nominal >= 55800000 && $result_nominal < 60400000 ) {
            $pph21 = 19;
        } elseif($result_nominal >= 60400000 && $result_nominal < 66700000 ) {
            $pph21 = 20;
        } elseif($result_nominal >= 66700000 && $result_nominal < 74500000 ) {
            $pph21 = 21;
        } elseif($result_nominal >= 74500000 && $result_nominal < 83200000 ) {
            $pph21 = 22;
        } elseif($result_nominal >= 83200000 && $result_nominal < 95600000 ) {
            $pph21 = 23;
        } elseif($result_nominal >= 95600000 && $result_nominal < 110000000 ) {
            $pph21 = 24;
        } elseif($result_nominal >= 110000000 && $result_nominal < 134000000 ) {
            $pph21 = 25;
        } elseif($result_nominal >= 134000000 && $result_nominal < 169000000 ) {
            $pph21 = 26;
        } elseif($result_nominal >= 169000000 && $result_nominal < 221000000 ) {
            $pph21 = 27;
        } elseif($result_nominal >= 221000000 && $result_nominal < 390000000 ) {
            $pph21 = 28;
        } elseif($result_nominal >= 390000000 && $result_nominal < 463000000 ) {
            $pph21 = 29;
        } elseif($result_nominal >= 463000000 && $result_nominal < 561000000 ) {
            $pph21 = 30;
        } elseif($result_nominal >= 561000000 && $result_nominal < 709000000 ) {
            $pph21 = 31;
        } elseif($result_nominal >= 709000000 && $result_nominal < 965000000 ) {
            $pph21 = 32;
        } elseif($result_nominal >= 965000000 && $result_nominal < 1419000000 ) {
            $pph21 = 33;
        } elseif($result_nominal >= 1419000000  ) {
            $pph21 = 34;
        }
    
    }
    return $pph21;
}







function hitung_tunjangan($kategori, $tunjangan){
    $persenan = 0;

    if ($kategori == 'A') {

        if ($tunjangan >= 0 && $tunjangan < 5400000 ) {
            $persenan = 0;
        } elseif($tunjangan >= 5400000 && $tunjangan < 5650000 ) {
            $persenan = 0.25;
        } elseif($tunjangan >= 5650000 && $tunjangan < 5950000 ) {
            $persenan = 0.50;
        } elseif($tunjangan >= 5950000 && $tunjangan < 6300000 ) {
            $persenan = 0.75;
        } elseif($tunjangan >= 6300000 && $tunjangan < 6750000 ) {
            $persenan = 1;
        } elseif($tunjangan >= 6750000 && $tunjangan < 7500000 ) {
            $persenan = 1.25;
        } elseif($tunjangan >= 7500000 && $tunjangan < 8550000 ) {
            $persenan = 1.50;
        } elseif($tunjangan >= 8550000 && $tunjangan < 9650000 ) {
            $persenan = 1.75;
        } elseif($tunjangan >= 9650000 && $tunjangan < 10050000 ) {
            $persenan = 2;
        } elseif($tunjangan >= 10050000 && $tunjangan < 10350000 ) {
            $persenan = 2.25;
        } elseif($tunjangan >= 10350000 && $tunjangan < 10700000 ) {
            $persenan = 2.50;
        } elseif($tunjangan >= 10700000 && $tunjangan < 11050000 ) {
            $persenan = 3;
        } elseif($tunjangan >= 11050000 && $tunjangan < 11600000 ) {
            $persenan = 3.50;
        } elseif($tunjangan >= 11600000 && $tunjangan < 12500000 ) {
            $persenan = 4;
        } elseif($tunjangan >= 12500000 && $tunjangan < 13750000 ) {
            $persenan = 5;
        } elseif($tunjangan >= 13750000 && $tunjangan < 15100000 ) {
            $persenan = 6;
        } elseif($tunjangan >= 15100000 && $tunjangan < 16950000 ) {
            $persenan = 7;
        } elseif($tunjangan >= 16950000 && $tunjangan < 19750000 ) {
            $persenan = 8;
        } elseif($tunjangan >= 19750000 && $tunjangan < 24150000 ) {
            $persenan = 9;
        } elseif($tunjangan >= 24150000 && $tunjangan < 26450000 ) {
            $persenan = 10;
        } elseif($tunjangan >= 26450000 && $tunjangan < 28000000 ) {
            $persenan = 11;
        } elseif($tunjangan >= 28000000 && $tunjangan < 30050000 ) {
            $persenan = 12;
        } elseif($tunjangan >= 30050000 && $tunjangan < 32400000 ) {
            $persenan = 13;
        } elseif($tunjangan >= 32400000 && $tunjangan < 35400000 ) {
            $persenan = 14;
        } elseif($tunjangan >= 35400000 && $tunjangan < 39100000 ) {
            $persenan = 15;
        } elseif($tunjangan >= 39100000 && $tunjangan < 43850000 ) {
            $persenan = 16;
        } elseif($tunjangan >= 43850000 && $tunjangan < 47800000 ) {
            $persenan = 17;
        } elseif($tunjangan >= 47800000 && $tunjangan < 51400000 ) {
            $persenan = 18;
        } elseif($tunjangan >= 51400000 && $tunjangan < 56300000 ) {
            $persenan = 19;
        } elseif($tunjangan >= 56300000 && $tunjangan < 62200000 ) {
            $persenan = 20;
        } elseif($tunjangan >= 62200000 && $tunjangan < 68600000 ) {
            $persenan = 21;
        } elseif($tunjangan >= 68600000 && $tunjangan < 77500000 ) {
            $persenan = 22;
        } elseif($tunjangan >= 77500000 && $tunjangan < 89000000 ) {
            $persenan = 23;
        } elseif($tunjangan >= 89000000 && $tunjangan < 103000000 ) {
            $persenan = 24;
        } elseif($tunjangan >= 103000000 && $tunjangan < 125000000 ) {
            $persenan = 25;
        } elseif($tunjangan >= 125000000 && $tunjangan < 157000000 ) {
            $persenan = 26;
        } elseif($tunjangan >= 157000000 && $tunjangan < 206000000 ) {
            $persenan = 27;
        } elseif($tunjangan >= 206000000 && $tunjangan < 337000000 ) {
            $persenan = 28;
        } elseif($tunjangan >= 337000000 && $tunjangan < 454000000 ) {
            $persenan = 29;
        } elseif($tunjangan >= 454000000 && $tunjangan < 550000000 ) {
            $persenan = 30;
        } elseif($tunjangan >= 550000000 && $tunjangan < 695000000 ) {
            $persenan = 31;
        } elseif($tunjangan >= 695000000 && $tunjangan < 910000000 ) {
            $persenan = 32;
        } elseif($tunjangan >= 910000000 && $tunjangan < 1400000000 ) {
            $persenan = 33;
        } elseif($tunjangan >= 1400000000  ) {
            $persenan = 34;
        }
        
        }  elseif ($kategori == 'B') {
       
            if ($tunjangan >= 0 && $tunjangan < 6200000 ) {
            $persenan = 0;
        } elseif($tunjangan >= 6200000 && $tunjangan < 6500000 ) {
            $persenan = 0.25;
        } elseif($tunjangan >= 6500000 && $tunjangan < 6850000 ) {
            $persenan = 0.50;
        } elseif($tunjangan >= 6850000 && $tunjangan < 7300000 ) {
            $persenan = 0.75;
        } elseif($tunjangan >= 7300000 && $tunjangan < 9200000 ) {
            $persenan = 1;
        } elseif($tunjangan >= 9200000 && $tunjangan < 10750000 ) {
            $persenan = 1.50;
        } elseif($tunjangan >= 10750000 && $tunjangan < 11250000 ) {
            $persenan = 2;
        } elseif($tunjangan >= 11250000 && $tunjangan < 11600000 ) {
            $persenan = 2.5;
        } elseif($tunjangan >= 11600000 && $tunjangan < 12600000 ) {
            $persenan = 3;
        } elseif($tunjangan >= 12600000 && $tunjangan < 13600000 ) {
            $persenan = 4;
        } elseif($tunjangan >= 13600000 && $tunjangan < 14950000 ) {
            $persenan = 5;
        } elseif($tunjangan >= 14950000 && $tunjangan < 16400000 ) {
            $persenan = 6;
        } elseif($tunjangan >= 16400000 && $tunjangan < 18450000 ) {
            $persenan = 7;
        } elseif($tunjangan >= 18450000 && $tunjangan < 21850000 ) {
            $persenan = 8;
        } elseif($tunjangan >= 21850000 && $tunjangan < 26000000 ) {
            $persenan = 9;
        } elseif($tunjangan >= 26000000 && $tunjangan < 27700000 ) {
            $persenan = 10;
        } elseif($tunjangan >= 27700000 && $tunjangan < 29350000 ) {
            $persenan = 11;
        } elseif($tunjangan >= 29350000 && $tunjangan < 31450000 ) {
            $persenan = 12;
        } elseif($tunjangan >= 31450000 && $tunjangan < 33950000 ) {
            $persenan = 13;
        } elseif($tunjangan >= 33950000 && $tunjangan < 37100000 ) {
            $persenan = 14;
        } elseif($tunjangan >= 37100000 && $tunjangan < 41100000 ) {
            $persenan = 15;
        } elseif($tunjangan >= 41100000 && $tunjangan < 45800000 ) {
            $persenan = 16;
        } elseif($tunjangan >= 45800000 && $tunjangan < 49500000 ) {
            $persenan = 17;
        } elseif($tunjangan >= 49500000 && $tunjangan < 53800000 ) {
            $persenan = 18;
        } elseif($tunjangan >= 53800000 && $tunjangan < 58500000 ) {
            $persenan = 19;
        } elseif($tunjangan >= 58500000 && $tunjangan < 64000000 ) {
            $persenan = 20;
        } elseif($tunjangan >= 64000000 && $tunjangan < 71000000 ) {
            $persenan = 21;
        } elseif($tunjangan >= 71000000 && $tunjangan < 80000000 ) {
            $persenan = 22;
        } elseif($tunjangan >= 80000000 && $tunjangan < 93000000 ) {
            $persenan = 23;
        } elseif($tunjangan >= 93000000 && $tunjangan < 109000000 ) {
            $persenan = 24;
        } elseif($tunjangan >= 109000000 && $tunjangan < 129000000 ) {
            $persenan = 25;
        } elseif($tunjangan >= 129000000 && $tunjangan < 163000000 ) {
            $persenan = 26;
        } elseif($tunjangan >= 163000000 && $tunjangan < 211000000 ) {
            $persenan = 27;
        } elseif($tunjangan >= 211000000 && $tunjangan < 374000000 ) {
            $persenan = 28;
        } elseif($tunjangan >= 374000000 && $tunjangan < 459000000 ) {
            $persenan = 29;
        } elseif($tunjangan >= 459000000 && $tunjangan < 555000000 ) {
            $persenan = 30;
        } elseif($tunjangan >= 555000000 && $tunjangan < 704000000 ) {
            $persenan = 31;
        } elseif($tunjangan >= 704000000 && $tunjangan < 957000000 ) {
            $persenan = 32;
        } elseif($tunjangan >= 957000000 && $tunjangan < 1405000000 ) {
            $persenan = 33;
        } elseif($tunjangan >= 1405000000  ) {
            $persenan = 34;
        } 
    
    } elseif ($kategori == 'C') {
    
        if ($tunjangan >= 0 && $tunjangan < 6600000 ) {
            $persenan = 0;
        } elseif($tunjangan >= 6600000 && $tunjangan < 6950000 ) {
            $persenan = 0.25;
        } elseif($tunjangan >= 6950000 && $tunjangan < 7350000 ) {
            $persenan = 0.50;
        } elseif($tunjangan >= 7350000 && $tunjangan < 7800000 ) {
            $persenan = 0.75;
        } elseif($tunjangan >= 7800000 && $tunjangan < 8850000 ) {
            $persenan = 1;
        } elseif($tunjangan >= 8850000 && $tunjangan < 9800000 ) {
            $persenan = 1.25;
        } elseif($tunjangan >= 9800000 && $tunjangan < 10950000 ) {
            $persenan = 1.50;
        } elseif($tunjangan >= 10950000 && $tunjangan < 11200000 ) {
            $persenan = 1.75;
        } elseif($tunjangan >= 11200000 && $tunjangan < 12050000 ) {
            $persenan = 2;
        } elseif($tunjangan >= 12050000 && $tunjangan < 12950000 ) {
            $persenan = 3;
        } elseif($tunjangan >= 12950000 && $tunjangan < 14150000 ) {
            $persenan = 4;
        } elseif($tunjangan >= 14150000 && $tunjangan < 15500000 ) {
            $persenan = 5;
        } elseif($tunjangan >= 15500000 && $tunjangan < 17050000 ) {
            $persenan = 6;
        } elseif($tunjangan >= 17050000 && $tunjangan < 19500000 ) {
            $persenan = 7;
        } elseif($tunjangan >= 19500000 && $tunjangan < 22700000 ) {
            $persenan = 8;
        } elseif($tunjangan >= 22700000 && $tunjangan < 26600000 ) {
            $persenan = 9;
        } elseif($tunjangan >= 26600000 && $tunjangan < 28100000 ) {
            $persenan = 10;
        } elseif($tunjangan >= 28100000 && $tunjangan < 30100000 ) {
            $persenan = 11;
        } elseif($tunjangan >= 30100000 && $tunjangan < 32600000 ) {
            $persenan = 12;
        } elseif($tunjangan >= 32600000 && $tunjangan < 35400000 ) {
            $persenan = 13;
        } elseif($tunjangan >= 35400000 && $tunjangan < 38900000 ) {
            $persenan = 14;
        } elseif($tunjangan >= 38900000 && $tunjangan < 43000000 ) {
            $persenan = 15;
        } elseif($tunjangan >= 43000000 && $tunjangan < 47400000 ) {
            $persenan = 16;
        } elseif($tunjangan >= 47400000 && $tunjangan < 51200000 ) {
            $persenan = 17;
        } elseif($tunjangan >= 51200000 && $tunjangan < 55800000 ) {
            $persenan = 18;
        } elseif($tunjangan >= 55800000 && $tunjangan < 60400000 ) {
            $persenan = 19;
        } elseif($tunjangan >= 60400000 && $tunjangan < 66700000 ) {
            $persenan = 20;
        } elseif($tunjangan >= 66700000 && $tunjangan < 74500000 ) {
            $persenan = 21;
        } elseif($tunjangan >= 74500000 && $tunjangan < 83200000 ) {
            $persenan = 22;
        } elseif($tunjangan >= 83200000 && $tunjangan < 95600000 ) {
            $persenan = 23;
        } elseif($tunjangan >= 95600000 && $tunjangan < 110000000 ) {
            $persenan = 24;
        } elseif($tunjangan >= 110000000 && $tunjangan < 134000000 ) {
            $persenan = 25;
        } elseif($tunjangan >= 134000000 && $tunjangan < 169000000 ) {
            $persenan = 26;
        } elseif($tunjangan >= 169000000 && $tunjangan < 221000000 ) {
            $persenan = 27;
        } elseif($tunjangan >= 221000000 && $tunjangan < 390000000 ) {
            $persenan = 28;
        } elseif($tunjangan >= 390000000 && $tunjangan < 463000000 ) {
            $persenan = 29;
        } elseif($tunjangan >= 463000000 && $tunjangan < 561000000 ) {
            $persenan = 30;
        } elseif($tunjangan >= 561000000 && $tunjangan < 709000000 ) {
            $persenan = 31;
        } elseif($tunjangan >= 709000000 && $tunjangan < 965000000 ) {
            $persenan = 32;
        } elseif($tunjangan >= 965000000 && $tunjangan < 1419000000 ) {
            $persenan = 33;
        } elseif($tunjangan >= 1419000000  ) {
            $persenan = 34;
        }
    
    }
return $persenan;
}


function hitung_lastpph21($kategori, $tjpph21){
    $last_pph21 = 0;
    if ($kategori == 'A') {

        if ($tjpph21 >= 0 && $tjpph21 < 5400000 ) {
            $last_pph21 = 0;
        } elseif($tjpph21 >= 5400000 && $tjpph21 < 5650000 ) {
            $last_pph21 = 0.25;
        } elseif($tjpph21 >= 5650000 && $tjpph21 < 5950000 ) {
            $last_pph21 = 0.50;
        } elseif($tjpph21 >= 5950000 && $tjpph21 < 6300000 ) {
            $last_pph21 = 0.75;
        } elseif($tjpph21 >= 6300000 && $tjpph21 < 6750000 ) {
            $last_pph21 = 1;
        } elseif($tjpph21 >= 6750000 && $tjpph21 < 7500000 ) {
            $last_pph21 = 1.25;
        } elseif($tjpph21 >= 7500000 && $tjpph21 < 8550000 ) {
            $last_pph21 = 1.50;
        } elseif($tjpph21 >= 8550000 && $tjpph21 < 9650000 ) {
            $last_pph21 = 1.75;
        } elseif($tjpph21 >= 9650000 && $tjpph21 < 10050000 ) {
            $last_pph21 = 2;
        } elseif($tjpph21 >= 10050000 && $tjpph21 < 10350000 ) {
            $last_pph21 = 2.25;
        } elseif($tjpph21 >= 10350000 && $tjpph21 < 10700000 ) {
            $last_pph21 = 2.50;
        } elseif($tjpph21 >= 10700000 && $tjpph21 < 11050000 ) {
            $last_pph21 = 3;
        } elseif($tjpph21 >= 11050000 && $tjpph21 < 11600000 ) {
            $last_pph21 = 3.50;
        } elseif($tjpph21 >= 11600000 && $tjpph21 < 12500000 ) {
            $last_pph21 = 4;
        } elseif($tjpph21 >= 12500000 && $tjpph21 < 13750000 ) {
            $last_pph21 = 5;
        } elseif($tjpph21 >= 13750000 && $tjpph21 < 15100000 ) {
            $last_pph21 = 6;
        } elseif($tjpph21 >= 15100000 && $tjpph21 < 16950000 ) {
            $last_pph21 = 7;
        } elseif($tjpph21 >= 16950000 && $tjpph21 < 19750000 ) {
            $last_pph21 = 8;
        } elseif($tjpph21 >= 19750000 && $tjpph21 < 24150000 ) {
            $last_pph21 = 9;
        } elseif($tjpph21 >= 24150000 && $tjpph21 < 26450000 ) {
            $last_pph21 = 10;
        } elseif($tjpph21 >= 26450000 && $tjpph21 < 28000000 ) {
            $last_pph21 = 11;
        } elseif($tjpph21 >= 28000000 && $tjpph21 < 30050000 ) {
            $last_pph21 = 12;
        } elseif($tjpph21 >= 30050000 && $tjpph21 < 32400000 ) {
            $last_pph21 = 13;
        } elseif($tjpph21 >= 32400000 && $tjpph21 < 35400000 ) {
            $last_pph21 = 14;
        } elseif($tjpph21 >= 35400000 && $tjpph21 < 39100000 ) {
            $last_pph21 = 15;
        } elseif($tjpph21 >= 39100000 && $tjpph21 < 43850000 ) {
            $last_pph21 = 16;
        } elseif($tjpph21 >= 43850000 && $tjpph21 < 47800000 ) {
            $last_pph21 = 17;
        } elseif($tjpph21 >= 47800000 && $tjpph21 < 51400000 ) {
            $last_pph21 = 18;
        } elseif($tjpph21 >= 51400000 && $tjpph21 < 56300000 ) {
            $last_pph21 = 19;
        } elseif($tjpph21 >= 56300000 && $tjpph21 < 62200000 ) {
            $last_pph21 = 20;
        } elseif($tjpph21 >= 62200000 && $tjpph21 < 68600000 ) {
            $last_pph21 = 21;
        } elseif($tjpph21 >= 68600000 && $tjpph21 < 77500000 ) {
            $last_pph21 = 22;
        } elseif($tjpph21 >= 77500000 && $tjpph21 < 89000000 ) {
            $last_pph21 = 23;
        } elseif($tjpph21 >= 89000000 && $tjpph21 < 103000000 ) {
            $last_pph21 = 24;
        } elseif($tjpph21 >= 103000000 && $tjpph21 < 125000000 ) {
            $last_pph21 = 25;
        } elseif($tjpph21 >= 125000000 && $tjpph21 < 157000000 ) {
            $last_pph21 = 26;
        } elseif($tjpph21 >= 157000000 && $tjpph21 < 206000000 ) {
            $last_pph21 = 27;
        } elseif($tjpph21 >= 206000000 && $tjpph21 < 337000000 ) {
            $last_pph21 = 28;
        } elseif($tjpph21 >= 337000000 && $tjpph21 < 454000000 ) {
            $last_pph21 = 29;
        } elseif($tjpph21 >= 454000000 && $tjpph21 < 550000000 ) {
            $last_pph21 = 30;
        } elseif($tjpph21 >= 550000000 && $tjpph21 < 695000000 ) {
            $last_pph21 = 31;
        } elseif($tjpph21 >= 695000000 && $tjpph21 < 910000000 ) {
            $last_pph21 = 32;
        } elseif($tjpph21 >= 910000000 && $tjpph21 < 1400000000 ) {
            $last_pph21 = 33;
        } elseif($tjpph21 >= 1400000000  ) {
            $last_pph21 = 34;
        }
        
        }  elseif ($kategori == 'B') {
       
            if ($tjpph21 >= 0 && $tjpph21 < 6200000 ) {
            $last_pph21 = 0;
        } elseif($tjpph21 >= 6200000 && $tjpph21 < 6500000 ) {
            $last_pph21 = 0.25;
        } elseif($tjpph21 >= 6500000 && $tjpph21 < 6850000 ) {
            $last_pph21 = 0.50;
        } elseif($tjpph21 >= 6850000 && $tjpph21 < 7300000 ) {
            $last_pph21 = 0.75;
        } elseif($tjpph21 >= 7300000 && $tjpph21 < 9200000 ) {
            $last_pph21 = 1;
        } elseif($tjpph21 >= 9200000 && $tjpph21 < 10750000 ) {
            $last_pph21 = 1.50;
        } elseif($tjpph21 >= 10750000 && $tjpph21 < 11250000 ) {
            $last_pph21 = 2;
        } elseif($tjpph21 >= 11250000 && $tjpph21 < 11600000 ) {
            $last_pph21 = 2.5;
        } elseif($tjpph21 >= 11600000 && $tjpph21 < 12600000 ) {
            $last_pph21 = 3;
        } elseif($tjpph21 >= 12600000 && $tjpph21 < 13600000 ) {
            $last_pph21 = 4;
        } elseif($tjpph21 >= 13600000 && $tjpph21 < 14950000 ) {
            $last_pph21 = 5;
        } elseif($tjpph21 >= 14950000 && $tjpph21 < 16400000 ) {
            $last_pph21 = 6;
        } elseif($tjpph21 >= 16400000 && $tjpph21 < 18450000 ) {
            $last_pph21 = 7;
        } elseif($tjpph21 >= 18450000 && $tjpph21 < 21850000 ) {
            $last_pph21 = 8;
        } elseif($tjpph21 >= 21850000 && $tjpph21 < 26000000 ) {
            $last_pph21 = 9;
        } elseif($tjpph21 >= 26000000 && $tjpph21 < 27700000 ) {
            $last_pph21 = 10;
        } elseif($tjpph21 >= 27700000 && $tjpph21 < 29350000 ) {
            $last_pph21 = 11;
        } elseif($tjpph21 >= 29350000 && $tjpph21 < 31450000 ) {
            $last_pph21 = 12;
        } elseif($tjpph21 >= 31450000 && $tjpph21 < 33950000 ) {
            $last_pph21 = 13;
        } elseif($tjpph21 >= 33950000 && $tjpph21 < 37100000 ) {
            $last_pph21 = 14;
        } elseif($tjpph21 >= 37100000 && $tjpph21 < 41100000 ) {
            $last_pph21 = 15;
        } elseif($tjpph21 >= 41100000 && $tjpph21 < 45800000 ) {
            $last_pph21 = 16;
        } elseif($tjpph21 >= 45800000 && $tjpph21 < 49500000 ) {
            $last_pph21 = 17;
        } elseif($tjpph21 >= 49500000 && $tjpph21 < 53800000 ) {
            $last_pph21 = 18;
        } elseif($tjpph21 >= 53800000 && $tjpph21 < 58500000 ) {
            $last_pph21 = 19;
        } elseif($tjpph21 >= 58500000 && $tjpph21 < 64000000 ) {
            $last_pph21 = 20;
        } elseif($tjpph21 >= 64000000 && $tjpph21 < 71000000 ) {
            $last_pph21 = 21;
        } elseif($tjpph21 >= 71000000 && $tjpph21 < 80000000 ) {
            $last_pph21 = 22;
        } elseif($tjpph21 >= 80000000 && $tjpph21 < 93000000 ) {
            $last_pph21 = 23;
        } elseif($tjpph21 >= 93000000 && $tjpph21 < 109000000 ) {
            $last_pph21 = 24;
        } elseif($tjpph21 >= 109000000 && $tjpph21 < 129000000 ) {
            $last_pph21 = 25;
        } elseif($tjpph21 >= 129000000 && $tjpph21 < 163000000 ) {
            $last_pph21 = 26;
        } elseif($tjpph21 >= 163000000 && $tjpph21 < 211000000 ) {
            $last_pph21 = 27;
        } elseif($tjpph21 >= 211000000 && $tjpph21 < 374000000 ) {
            $last_pph21 = 28;
        } elseif($tjpph21 >= 374000000 && $tjpph21 < 459000000 ) {
            $last_pph21 = 29;
        } elseif($tjpph21 >= 459000000 && $tjpph21 < 555000000 ) {
            $last_pph21 = 30;
        } elseif($tjpph21 >= 555000000 && $tjpph21 < 704000000 ) {
            $last_pph21 = 31;
        } elseif($tjpph21 >= 704000000 && $tjpph21 < 957000000 ) {
            $last_pph21 = 32;
        } elseif($tjpph21 >= 957000000 && $tjpph21 < 1405000000 ) {
            $last_pph21 = 33;
        } elseif($tjpph21 >= 1405000000  ) {
            $last_pph21 = 34;
        } 
    
    } elseif ($kategori == 'C') {
    
        if ($tjpph21 >= 0 && $tjpph21 < 6600000 ) {
            $last_pph21 = 0;
        } elseif($tjpph21 >= 6600000 && $tjpph21 < 6950000 ) {
            $last_pph21 = 0.25;
        } elseif($tjpph21 >= 6950000 && $tjpph21 < 7350000 ) {
            $last_pph21 = 0.50;
        } elseif($tjpph21 >= 7350000 && $tjpph21 < 7800000 ) {
            $last_pph21 = 0.75;
        } elseif($tjpph21 >= 7800000 && $tjpph21 < 8850000 ) {
            $last_pph21 = 1;
        } elseif($tjpph21 >= 8850000 && $tjpph21 < 9800000 ) {
            $last_pph21 = 1.25;
        } elseif($tjpph21 >= 9800000 && $tjpph21 < 10950000 ) {
            $last_pph21 = 1.50;
        } elseif($tjpph21 >= 10950000 && $tjpph21 < 11200000 ) {
            $last_pph21 = 1.75;
        } elseif($tjpph21 >= 11200000 && $tjpph21 < 12050000 ) {
            $last_pph21 = 2;
        } elseif($tjpph21 >= 12050000 && $tjpph21 < 12950000 ) {
            $last_pph21 = 3;
        } elseif($tjpph21 >= 12950000 && $tjpph21 < 14150000 ) {
            $last_pph21 = 4;
        } elseif($tjpph21 >= 14150000 && $tjpph21 < 15500000 ) {
            $last_pph21 = 5;
        } elseif($tjpph21 >= 15500000 && $tjpph21 < 17050000 ) {
            $last_pph21 = 6;
        } elseif($tjpph21 >= 17050000 && $tjpph21 < 19500000 ) {
            $last_pph21 = 7;
        } elseif($tjpph21 >= 19500000 && $tjpph21 < 22700000 ) {
            $last_pph21 = 8;
        } elseif($tjpph21 >= 22700000 && $tjpph21 < 26600000 ) {
            $last_pph21 = 9;
        } elseif($tjpph21 >= 26600000 && $tjpph21 < 28100000 ) {
            $last_pph21 = 10;
        } elseif($tjpph21 >= 28100000 && $tjpph21 < 30100000 ) {
            $last_pph21 = 11;
        } elseif($tjpph21 >= 30100000 && $tjpph21 < 32600000 ) {
            $last_pph21 = 12;
        } elseif($tjpph21 >= 32600000 && $tjpph21 < 35400000 ) {
            $last_pph21 = 13;
        } elseif($tjpph21 >= 35400000 && $tjpph21 < 38900000 ) {
            $last_pph21 = 14;
        } elseif($tjpph21 >= 38900000 && $tjpph21 < 43000000 ) {
            $last_pph21 = 15;
        } elseif($tjpph21 >= 43000000 && $tjpph21 < 47400000 ) {
            $last_pph21 = 16;
        } elseif($tjpph21 >= 47400000 && $tjpph21 < 51200000 ) {
            $last_pph21 = 17;
        } elseif($tjpph21 >= 51200000 && $tjpph21 < 55800000 ) {
            $last_pph21 = 18;
        } elseif($tjpph21 >= 55800000 && $tjpph21 < 60400000 ) {
            $last_pph21 = 19;
        } elseif($tjpph21 >= 60400000 && $tjpph21 < 66700000 ) {
            $last_pph21 = 20;
        } elseif($tjpph21 >= 66700000 && $tjpph21 < 74500000 ) {
            $last_pph21 = 21;
        } elseif($tjpph21 >= 74500000 && $tjpph21 < 83200000 ) {
            $last_pph21 = 22;
        } elseif($tjpph21 >= 83200000 && $tjpph21 < 95600000 ) {
            $last_pph21 = 23;
        } elseif($tjpph21 >= 95600000 && $tjpph21 < 110000000 ) {
            $last_pph21 = 24;
        } elseif($tjpph21 >= 110000000 && $tjpph21 < 134000000 ) {
            $last_pph21 = 25;
        } elseif($tjpph21 >= 134000000 && $tjpph21 < 169000000 ) {
            $last_pph21 = 26;
        } elseif($tjpph21 >= 169000000 && $tjpph21 < 221000000 ) {
            $last_pph21 = 27;
        } elseif($tjpph21 >= 221000000 && $tjpph21 < 390000000 ) {
            $last_pph21 = 28;
        } elseif($tjpph21 >= 390000000 && $tjpph21 < 463000000 ) {
            $last_pph21 = 29;
        } elseif($tjpph21 >= 463000000 && $tjpph21 < 561000000 ) {
            $last_pph21 = 30;
        } elseif($tjpph21 >= 561000000 && $tjpph21 < 709000000 ) {
            $last_pph21 = 31;
        } elseif($tjpph21 >= 709000000 && $tjpph21 < 965000000 ) {
            $last_pph21 = 32;
        } elseif($tjpph21 >= 965000000 && $tjpph21 < 1419000000 ) {
            $last_pph21 = 33;
        } elseif($tjpph21 >= 1419000000  ) {
            $last_pph21 = 34;
        }
    
    }
    return $last_pph21;
}
}

// Definisikan fungsi-fungsi bantuan lainnya sesuai kebutuhan
