@extends('staf.layouts.main')
@section("content")

<!-- Column Search -->
<div class="card">
    <h5 class="card-header pb-0 text-md-start text-center">Daftar Barang Tersedia</h5>
    <div class="card-datatable text-nowrap">
      <table class="dt-column-search table table-bordered table-responsive">
        <thead>
          <tr>
            <th>Gambar</th>
            <th>ID Barang</th>
            <th>Nama Barang</th>
            <th>Deskripsi</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>Harga</th>
            <th>Tanggal Masuk</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Gambar</th>
            <th>ID Barang</th>
            <th>Nama Barang</th>
            <th>Deskripsi</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>Harga</th>
            <th>Tanggal Masuk</th>
          </tr>
        </tfoot>
      </table>
    </div>
</div>
  <!--/ Column Search -->


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dt_filter_table = document.querySelector('.dt-column-search');
        if (dt_filter_table) {
            const thead = dt_filter_table.querySelector('thead');

            const cloneRow = thead.querySelector('tr').cloneNode(true);
            thead.appendChild(cloneRow);

            const secondRowCells = thead.querySelectorAll('tr:nth-child(2) th');

            secondRowCells.forEach((th, i) => {
                const title = th.textContent.trim();

                if (i === 0) {
                    th.innerHTML = '';
                    return;
                }

                const input = document.createElement('input');
                input.type = 'text';
                input.className = 'form-control';
                input.placeholder = `Cari ${title}`;

                th.style.borderLeft = 'none';
                if (i === secondRowCells.length - 1) {
                    th.style.borderRight = 'none';
                }

                th.innerHTML = '';
                th.appendChild(input);

                input.addEventListener('keyup', function () {
                    if (dt_filter.column(i).search() !== this.value) {
                        dt_filter.column(i).search(this.value).draw();
                    }
                });

                input.addEventListener('change', function () {
                    if (dt_filter.column(i).search() !== this.value) {
                        dt_filter.column(i).search(this.value).draw();
                    }
                });
            });


            let dt_filter = new DataTable(dt_filter_table, {
                processing: true,
                serverSide: true,
                ajax: '{{ route("barang-tersedia.data") }}',
                columns: [
                    {
                        data: 'gambar',
                        name: 'gambar',
                        render: function (data, type, row) {
                            let imageUrl = data ? `/storage/gambar/${data}` : '{{ asset("assets/img/default_barang.jpg") }}';
                            return `<a href="${imageUrl}" target="_blank">
                                        <img src="${imageUrl}" alt="Barang" width="60">
                                    </a>`;
                        }
                    },
                    { data: 'ID_barang', name: 'ID_barang' },
                    { data: 'nama_barang', name: 'nama_barang' },
                    { data: 'deskripsi', name: 'deskripsi' },
                    { data: 'jumlah', name: 'jumlah' },
                    { data: 'satuan', name: 'satuan' },
                    {
                        data: 'harga',
                        name: 'harga',
                        render: function(data, type, row) {
                            if(type === 'display' || type === 'filter') {
                            return 'Rp ' + Number(data).toLocaleString('id-ID');
                            }
                            return data;
                        }
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function (data, type, full, meta) {
                            const tanggal = new Date(full['created_at']);
                            return tanggal.toLocaleDateString('id-ID');
                        }
                    }
                ],
                createdRow: function (row, data, dataIndex) {
                    if (data.jumlah <= 5) {
                        row.classList.add('table-danger');
                    }
                },
                orderCellsTop: true,
                layout: {
                    topStart: {
                        rowClass: 'row mx-3 my-0 justify-content-between',
                        features: [
                            {
                                pageLength: {
                                    menu: [7, 10, 25, 50, 100],
                                    text: 'Tampilkan_MENU_data'
                                }
                            }
                        ]
                    },
                    topEnd: {
                        search: {
                            placeholder: 'Apa yang Anda cari?'
                        }
                    },
                    bottomStart: {
                        rowClass: 'row mx-3 justify-content-between',
                        features: ['info']
                    },
                    bottomEnd: 'paging'
                },
                language: {
                    paginate: {
                        next: '<i class="icon-base ti tabler-chevron-right scaleX-n1-rtl icon-18px"></i>',
                        previous: '<i class="icon-base ti tabler-chevron-left scaleX-n1-rtl icon-18px"></i>',
                        first: '<i class="icon-base ti tabler-chevrons-left scaleX-n1-rtl icon-18px"></i>',
                        last: '<i class="icon-base ti tabler-chevrons-right scaleX-n1-rtl icon-18px"></i>'
                    }
                }
            });
        }
    });
</script>

@endsection
