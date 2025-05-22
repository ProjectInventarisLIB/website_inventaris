<p>Kepada Yth.<br>
PT. Lintas Internasional Berkarya<br>
Direktur Utama</p>

<p>Dengan hormat,</p>

<p>Sehubungan dengan adanya kebutuhan <strong>{{ $pengadaan->tujuan }}</strong>, melalui surat ini kami mengajukan permohonan pengadaan barang mendesak
yang dibutuhkan pada tanggal <strong>{{ \Carbon\Carbon::parse($pengadaan->created_at)->format('d-m-Y') }}</strong> dengan rincian sebagai berikut:</p>

@foreach($items as $item)
<p>
Nama Barang: {{ $item['nama_barang'] }}<br>
Jumlah: {{ $item['jumlah'] }} {{ $item['satuan'] }}<br>
Deskripsi: {{ $item['deskripsi'] ?? '-' }}
</p>
@endforeach


<p>Demikian surat permohonan ini kami sampaikan. Atas perhatian dan kerjasamanya, kami ucapkan terima kasih.</p>
