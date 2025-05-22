<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Menu;
use App\Models\Lokasi;
use App\Models\Jabatan;
use App\Models\Department;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'surname' => 'Heru Hidayat',
            'username' => 'master',
            'password' => bcrypt('admin'),
            'email' => 'tes@gmail.com',
            'status' => 'AKTIF',
            'is_admin' => '1',
            'is_trash' => '0'
        ]);

        User::create([
            'surname' => 'Huda',
            'username' => 'tesb',
            'password' => bcrypt('admin'),
            'email' => 'teass@gmail.com',
            'status' => 'AKTIF',
            'is_admin' => '0',
       
            'is_trash' => '0'
        ]);

        User::create([
            'surname' => 'andi',
            'username' => 'tesa',
            'password' => bcrypt('admin'),
            'email' => 'teasss@gmail.com',
            'status' => 'AKTIF',
            'is_admin' => '1',
          
            'is_trash' => '0'
        ]);



        // User::create([
        //     'name' => 'Budi Aldi',
        //     'email' => 'bdiald435@gmail.com',
        //     'password' => bcrypt('12345')
        // ]);

        // Karyawan::factory(19)->create(); 

        Jabatan::factory(26)->create(); 

        Lokasi::create([
            'nama_lokasi' => 'Kantor Balikpapan',        
            'long' => ' -1.246303809280611',  
            'lat' => '116.8653695950346',  
            
        ]);
        Lokasi::create([
            'nama_lokasi' => 'Kantor Bontang',
            'long' => '23435446',  
            'lat' => '265546546456',          
        ]);




     
    
      
    
  

        Karyawan::create([
            'nama_lengkap' => 'Margo sucipto', 
            'jenis_kelamin' =>  'Laki-Laki',  
             'status_bpjs' =>  'K/3',   
            'tanggal_lahir' =>       '1982-02-19',
             'alamat'  => 'JL. RE. Martadinata No.39, RT.063, Kel. Gunung Sari Ilir, Kec. Balikpapan Tengah, Kota',
             'agama'   =>        'Islam',
               'no_ktp'   =>               '6471051802820002',
               'jabatan' => 'Direktur Utama', 
             'nip' => '22010002',
             'jenis_bank' => 'MANDIRI',
             'no_wa' => '0874379382939',
             'no_rekening' => '843973327',
             'email' => 'dfjsfnkdsj@dsnskjfnksdf.com' 
             
             ]);

        Karyawan::create([
            'nama_lengkap' =>    'Rachmat Saleh',
            'jenis_kelamin' =>  'Laki-Laki',  
             'status_bpjs' => 'K/3',    
            'tanggal_lahir' =>         '1980-12-30',
            'alamat'  =>  'JL. Borobudur No.3, RT.38, Kel. Muara Rapak, Kec. Balikpapan Utara, Kota Balikpapan',
            'agama'   =>        'Islam',
              'no_ktp'   =>                                    '6471043012800004',
              'jabatan' =>                                                       'Accounting', 
        'nip' => '22010003',
        'jenis_bank' => 'MANDIRI',
        'no_wa' => '0874379382939',
        'no_rekening' => '843973327',
        'email' => 'dfjsfnkdsj@dsnskjfnksdf.com' 
        
        ]);

        Karyawan::create([
            'nama_lengkap' =>    'Sarwo Eddy Wibowo', 
            'jenis_kelamin' =>  'Laki-Laki',  
             'status_bpjs' =>  'K/0',   
            'tanggal_lahir' =>      '1914-02-16',
            'alamat'  =>    'Komp. Graha Indah Blok G No.7, RT.003, Kel. Graha Indah, Kec. Balikpapan Utara, Kota Blaikpapan',
            'agama'   =>        'Islam',
              'no_ktp'   =>                                    '6471031602940000',
              'jabatan' =>                                                       'HRD',
        'nip' => '22010004',
        'jenis_bank' => 'MANDIRI',
        'no_wa' => '0874379382939',
        'no_rekening' => '843973327',
        'email' => 'dfjsfnkdsj@dsnskjfnksdf.com' 
        
        ]);

        Karyawan::create([
            'nama_lengkap' =>     'Edo Nusa Herlangga',
            'jenis_kelamin' =>  'Laki-Laki',  
             'status_bpjs' =>  'K/0',   
            'tanggal_lahir' =>     '1991-10-23',
            'alamat'  =>         'JL. Karya Etam GG. Merdeka 2 No.24, RT.054, Kel. Sanagata Utara, Kec. Sangata Utara, Kabupaten Kutai Timur',
            'agama'   =>        'Islam',
              'no_ktp'   =>                                    '6471022310910001',
              'jabatan' =>                                                       'Kepala Oprasional', 
        'nip' => '22010005',
        'jenis_bank' => 'MANDIRI',
        'no_wa' => '0874379382939',
        'no_rekening' => '843973327',
        'email' => 'dfjsfnkdsj@dsnskjfnksdf.com' 
        
        ]);

        Karyawan::create([
            'nama_lengkap' =>   'Julya Nurrahmawati', 
            'jenis_kelamin' => 'Perempuan',  
             'status_bpjs' =>  'K/3',   
            'tanggal_lahir' =>   '1994-07-23',
            'alamat'  =>        'JL. R Soeprapto RT.024, Kel. Api-Api, Kec. Bontang Utara, Kota Bontang',
            'agama'   =>        'Islam',
              'no_ktp'   =>                                    '6474016307940000',
              'jabatan' =>                                                       'Administrasi', 
        'nip' => '22010006',
        'jenis_bank' => 'MANDIRI',
        'no_wa' => '0874379382939',
        'no_rekening' => '843973327',
        'email' => 'dfjsfnkdsj@dsnskjfnksdf.com' 
        
        ]);

        Karyawan::create([
            'nama_lengkap' =>  'Sri Nurhayati',
            'jenis_kelamin' => 'Perempuan',  
             'status_bpjs' =>    'K/2', 
            'tanggal_lahir' =>   '1976-07-11', 
            'alamat'  =>            'JL. Prapatan Pagar Ijo No.52, RT.027, Kel. Prapatan, Kec. Balikpapan Kota, Kota Balikpapan',
            'agama'   =>        'Islam',
              'no_ktp'   =>                                     '6471035107760000',
              'jabatan' =>                                                       'Finance',
        'nip' => '22010015',
        'jenis_bank' => 'MANDIRI',
        'no_wa' => '0874379382939',
        'no_rekening' => '843973327',
        'email' => 'dfjsfnkdsj@dsnskjfnksdf.com' 
        
        ]);
        
     
       
        
      
        
        Karyawan::create([
            'nama_lengkap' =>   'Yosi Anum', 
            'jenis_kelamin' => 'Perempuan',  
             'status_bpjs' =>     'K/0',
            'tanggal_lahir' =>      '1998-07-18',   
            'alamat'  =>                          'Dusun VIII Suka Makmur RT.002, RW. 001, Kel. Telaga Said, Kec. Sei Lepan, Kabupaten Langkat',
            'agama'   =>        'Islam',
              'no_ktp'   =>                                     '1205175807980000',
              'jabatan' =>                                                       'Radio Operator', 
        'nip' => '23010017',
        'jenis_bank' => 'MANDIRI',
        'no_wa' => '0874379382939',
        'no_rekening' => '843973327',
        'email' => 'dfjsfnkdsj@dsnskjfnksdf.com' 
        
        ]);

        Karyawan::create([
            'nama_lengkap' =>      'Heri Suprasojo',
            'jenis_kelamin' =>   'Laki-Laki',  
             'status_bpjs' =>  'K/1',   
            'tanggal_lahir' =>       '1978-06-16',
            'alamat'  =>                          'JL. Karunia No. 286 B, RT.021, RW.006, Kel. Komperta, Kec. Plaju, Kota Palembang',
            'agama'   =>        'Islam',
              'no_ktp'   =>                                     '1671141606780010',
              'jabatan' =>                                                       'Pilot Pandu',
        'nip' => '22010008',
        'jenis_bank' => 'MANDIRI',
        'no_wa' => '0874379382939',
        'no_rekening' => '843973327',
        'email' => 'dfjsfnkdsj@dsnskjfnksdf.com' 
        
        ]);

        Karyawan::create([
            'nama_lengkap' =>     'Hendwi Hari Setiawan', 
            'jenis_kelamin' =>   'Laki-Laki',  
             'status_bpjs' =>   'K/2',  
            'tanggal_lahir' =>         '1978-06-03',
            'alamat'  =>                          'Perum Pondok Hijau Blok D/2, RT.009, RW.001, Kel. Wates, Kec. Ngaliyan, Kota Semarang',
            'agama'   =>        'Islam',
              'no_ktp'   =>                                     '3374060306780000',
              'jabatan' =>                                                       'Pilot Pandu', 
        'nip' => '22010010',
        'jenis_bank' => 'MANDIRI',
        'no_wa' => '0874379382939',
        'no_rekening' => '843973327',
        'email' => 'dfjsfnkdsj@dsnskjfnksdf.com' 
        
        ]);

        Karyawan::create([
            'nama_lengkap' =>     'Mursalin',
            'jenis_kelamin' =>   'Laki-Laki',  
             'status_bpjs' =>   'K/3',  
            'tanggal_lahir' =>       '1975-01-26',
            'alamat'  =>                          'JL. Damar Raya Blok D No.508, RT.004, RW.018, Kel. Margahayu, Kec. Bekasi Timur, Kota Bekasi',
            'agama'   =>        'Islam',
              'no_ktp'   =>                                     '3275012601750010',
              'jabatan' =>                 'Pilot Pandu',
        'nip' => '22010012',
        'jenis_bank' => 'MANDIRI',
        'no_wa' => '0874379382939',
        'no_rekening' => '843973327',
        'email' => 'dfjsfnkdsj@dsnskjfnksdf.com' 
        
        ]);





        Karyawan::create([
            'nama_lengkap' => 'Anjar Pantorosidi',     
            'jenis_kelamin' =>     'Laki-Laki',  
             'status_bpjs' =>'K/2',    
            'tanggal_lahir' =>   '1969-05-01',      
            'alamat'  =>  'Perum ABR Blok A.2/2, RT.003, RW.009, Kel. Kembangan, Kec. Kebomas, Kabupaten Gresik',                    
            'agama'   =>  'Islam',       
              'no_ktp'   => '3525140105690003',                        
              'jabatan' =>        'Pilot Pandu',                  
        'nip' => '22010013',
        'jenis_bank' => 'MANDIRI',
        'no_wa' => '0874379382939',
        'no_rekening' => '843973327',
        'email' => 'dfjsfnkdsj@dsnskjfnksdf.com' 
        ]);

        Karyawan::create([
            'nama_lengkap' =>            'Irfan Abidin',    
            'jenis_kelamin' =>                'Laki-Laki',  
             'status_bpjs' =>             'K/0',    
            'tanggal_lahir' =>                 '1994-07-13',      
            'alamat'  =>                         'JL. Veteran, RT.021, Kel. Brebas Tengah, Kec. Bontang Selatan, Kota Bontang',                    
            'agama'   =>                     'Islam',       
              'no_ktp'   =>                             '7315111307940000',                        
              'jabatan' =>                                                      'Radio Operator',                 
        'nip' => '22010021',
        'jenis_bank' => 'MANDIRI',
        'no_wa' => '0874379382939',
        'no_rekening' => '843973327',
        'email' => 'dfjsfnkdsj@dsnskjfnksdf.com' 
        ]);


        Karyawan::create([
            'nama_lengkap' =>            'Fandi Lukpi',     
            'jenis_kelamin' =>                'Laki-Laki',  
             'status_bpjs' =>             'K/0',    
            'tanggal_lahir' =>                 '1992-08-09',      
            'alamat'  =>                         'JL. Gurami RT.03, Kelurahan Tanjung Laut Indah, Kecamatan Bontang Selatan',                    
            'agama'   =>                     'Islam',       
              'no_ktp'   =>                             '6474020808920012',                        
              'jabatan' =>                                                      'Radio Operator',                  
        'nip' => '22010020',
        'jenis_bank' => 'MANDIRI',
        'no_wa' => '0874379382939',
        'no_rekening' => '843973327',
        'email' => 'dfjsfnkdsj@dsnskjfnksdf.com' 
        ]);


        Karyawan::create([
            'nama_lengkap' =>            'Mokhamad Azis Muslim',    
            'jenis_kelamin' =>                'Laki-Laki',  
             'status_bpjs' =>             'K/3',    
            'tanggal_lahir' =>                 '1969-09-10',      
            'alamat'  =>                         'Jl. Asep Berlian, GG. Wargaluyu No. 2 RT. 001 RW. 005',                    
            'agama'   =>                     'Islam',       
              'no_ktp'   =>                             '3273301009690000',                        
              'jabatan' =>                                                      'Direktur Operasional',                 
        'nip' => '23010022',
        'jenis_bank' => 'MANDIRI',
        'no_wa' => '0874379382939',
        'no_rekening' => '843973327',
        'email' => 'dfjsfnkdsj@dsnskjfnksdf.com' 
        ]);


        Karyawan::create([
            'nama_lengkap' =>            'David Cristian',     
            'jenis_kelamin' =>                'Laki-Laki',  
             'status_bpjs' =>             'TK/0',    
            'tanggal_lahir' =>                 '1986-04-13',      
            'alamat'  =>                         '-',                    
            'agama'   =>                     'Kristen Katolik',       
              'no_ktp'   =>                             '6471031304860001',                        
              'jabatan' =>                                                      'Wakil Direktur',                  
        'nip' => '',
        'jenis_bank' => 'MANDIRI',
        'no_wa' => '0874379382939',
        'no_rekening' => '843973327',
        'email' => 'dfjsfnkdsj@dsnskjfnksdf.com' 
        ]);


        Karyawan::create([
            'nama_lengkap' =>            'Wisnu Budhi Putera',    
            'jenis_kelamin' =>                'Laki-Laki',  
             'status_bpjs' =>             'K/3',    
            'tanggal_lahir' =>                 '1980-11-19',      
            'alamat'  =>                         'Jl. Maleer Indah III No. 42 A RT. 009 RW. 003 Batununggal, Bandung',                    
            'agama'   =>                     'Kristen Protestan',       
              'no_ktp'   =>                             '3273131911800000',                        
              'jabatan' =>                                                      'Direktur Keuangan',                 
        'nip' => '23050025',
        'jenis_bank' => 'MANDIRI',
        'no_wa' => '0874379382939',
        'no_rekening' => '843973327',
        'email' => 'dfjsfnkdsj@dsnskjfnksdf.com' 
        ]);


        Karyawan::create([
            'nama_lengkap' =>            'Helmy Yusriyyah',    
            'jenis_kelamin' =>                'Perempuan',  
             'status_bpjs' =>             'TK/0',    
            'tanggal_lahir' =>                 '1999-12-26',      
            'alamat'  =>                         'Jl. Nangka No.20 RT.27 BTN-PKT, Kel Blimbing Kec Bontang Barat, Bontang, Kaltim',                    
            'agama'   =>                     'Islam',       
              'no_ktp'   =>                             '7312056612990001',                        
              'jabatan' =>                                                      'Radio Operator',                 
        'nip' => '23070026',
        'jenis_bank' => 'MANDIRI',
        'no_wa' => '0874379382939',
        'no_rekening' => '843973327',
        'email' => 'dfjsfnkdsj@dsnskjfnksdf.com' 
        ]);


        Karyawan::create([
            'nama_lengkap' =>            'Abdul Hamid',     
            'jenis_kelamin' =>                'Laki-Laki',  
             'status_bpjs' =>             'K/2',    
            'tanggal_lahir' =>                 '1991-12-31',      
            'alamat'  =>                         'Jl. Sidrap RT. 21 Kel. Guntung Kec. Bontang Utara Kota Bontang ',                    
            'agama'   =>                     'Islam',       
              'no_ktp'   =>                             '5202063112920034',                        
              'jabatan' =>                                                      'General Affairs',                  
        'nip' => '23100027',
        'jenis_bank' => 'MANDIRI',
        'no_wa' => '0874379382939',
        'no_rekening' => '843973327',
        'email' => 'dfjsfnkdsj@dsnskjfnksdf.com' 
        ]);


        Karyawan::create([
            'nama_lengkap' =>            'Kukuh Prasetiyo Wibowo',    
            'jenis_kelamin' =>                'Laki-Laki',  
             'status_bpjs' =>             'K/2',    
            'tanggal_lahir' =>                 '1982-12-25',      
            'alamat'  =>                         'Jl. Dua No. 1 RT. 15 Kelurahan Gn. Samarinda, Balikpapan',                    
            'agama'   =>                     'Islam',       
              'no_ktp'   =>                             '6471032512820008',                        
              'jabatan' =>                                                      'HSE Supervisor',                 
        'nip' => '23120028',
        'jenis_bank' => 'MANDIRI',
        'no_wa' => '0874379382939',
        'no_rekening' => '843973327',
        'email' => 'dfjsfnkdsj@dsnskjfnksdf.com' 
        ]);





        
    

    }
}
