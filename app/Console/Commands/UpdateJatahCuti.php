<?php

namespace App\Console\Commands;

use App\Models\Karyawan;
use App\Models\JatahCuti;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateJatahCuti extends Command
{
    protected $signature = 'cuti:update';
    protected $description = 'Update jatah cuti karyawan';

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
     * @return int
     */
    public function handle()
    {
        $karyawans = Karyawan::all();

        foreach ($karyawans as $karyawan) {
            $this->updateJatahCuti($karyawan);
        }

        $this->info('Jatah cuti telah diperbarui.');
    }

    private function updateJatahCuti($karyawan)
    {
        // Mendapatkan tanggal sekarang dengan zona waktu Asia/Makassar
        $now = Carbon::now('Asia/Makassar')->format('Y-m-d');

        $karyawan_tanggal_mulai_kerja = $karyawan->tanggal_mulai_kerja;

        // Periksa apakah tanggal mulai kerja karyawan valid
        if (empty($karyawan_tanggal_mulai_kerja)) {
            $this->error("Tanggal mulai kerja karyawan dengan ID {$karyawan->id} kosong atau tidak valid.");
            return; // Skip karyawan ini
        }

        // Mengonversi tanggal mulai kerja ke objek Carbon
        try {
            $tanggal_mulai = Carbon::createFromFormat('Y-m-d', $karyawan_tanggal_mulai_kerja);
        } catch (\Exception $e) {
            $this->error("Gagal mengonversi tanggal mulai kerja untuk karyawan ID {$karyawan->id}: " . $e->getMessage());
            return; // Skip karyawan ini jika gagal mengonversi tanggal
        }

        // Mendapatkan tanggal sekarang dan membandingkan format bulan-tanggal
        $sekarang = Carbon::createFromFormat('Y-m-d', $now);
        $karyawan_tanggal_mulai_kerja2 = $tanggal_mulai->format('m-d');
        $skr = $sekarang->format('m-d');

        // Tambahkan 6 bulan ke tanggal mulai kerja
        $tanggal_enam_bulan2 = $tanggal_mulai->addMonths(6)->format('m-d');

        // Debugging: Periksa hasil perbandingan tanggal
        $this->info("Tanggal sekarang: $skr, Tanggal mulai kerja karyawan: $karyawan_tanggal_mulai_kerja2, Tanggal 6 bulan setelahnya: $tanggal_enam_bulan2");

        // Memeriksa apakah bulan dan tanggalnya sama
        if ($skr == $karyawan_tanggal_mulai_kerja2) {
            $jatahCuti = JatahCuti::where('id_karyawan', $karyawan->id)->first();

            // Cek jika tidak ada data cuti untuk karyawan ini
            if (!$jatahCuti) {
                $this->error("Tidak ditemukan data cuti untuk karyawan ID {$karyawan->id}");
                return; // Skip jika tidak ada data cuti
            }

        // dd('masuk',$tanggal_enam_bulan2->format('m-d'),$skr);
    $sisa_cuti_tahun_sebelumnya = $jatahCuti->sisa_cuti_tahun_sebelumnya;
    $sisa_cuti_tahun_ini = $jatahCuti->sisa_cuti_tahun_ini;
    $new_sisa_tahun_ini = $sisa_cuti_tahun_ini + 12;
    if ( $new_sisa_tahun_ini > 12) {
      JatahCuti::where('id', $jatahCuti->id)->update([
        'sisa_cuti_tahun_sebelumnya' => $sisa_cuti_tahun_ini ,
        'sisa_cuti_tahun_ini' => 12
      ]);
    }elseif($new_sisa_tahun_ini < 0){
      JatahCuti::where('id', $jatahCuti->id)->update([
        'sisa_cuti_tahun_ini' => $new_sisa_tahun_ini
      ]);
    }elseif ($new_sisa_tahun_ini >= 0 && $new_sisa_tahun_ini <= 12) {
      $val = $new_sisa_tahun_ini + 12;
      JatahCuti::where('id', $jatahCuti->id)->update([
            'sisa_cuti_tahun_ini' => $new_sisa_tahun_ini
      ]);
    }

            $this->info("Jatah cuti untuk karyawan ID {$karyawan->id} telah diperbarui.");
        } else {
            // Jika tanggal tidak cocok, Anda bisa menambahkan log atau info jika diperlukan
            $this->info("Tidak ada perubahan jatah cuti untuk karyawan ID {$karyawan->id}.");
        }
    }
}
