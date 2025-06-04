@extends('staf.layouts.main')
@section("content")

<div class="card mb-6">
    <div class="card-widget-separator-wrapper">
      <div class="card-body card-widget-separator">
        <div class="row gy-4 gy-sm-1">
          <div class="col-sm-6 col-lg-3">
            <div
              class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-4 pb-sm-0">
              <div>
                <h4 class="mb-0">{{ $statusCounts['Diproses'] }}</h4>
                <p class="mb-0">Surat Diproses</p>
              </div>
              <span class="avatar me-sm-6">
                <span class="avatar-initial rounded bg-label-warning">
                  <i class="icon-base ti tabler-calendar-stats icon-26px"></i>
                </span>
              </span>
            </div>
            <hr class="d-none d-sm-block d-lg-none me-6" />
          </div>
          <div class="col-sm-6 col-lg-3">
            <div
              class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-4 pb-sm-0">
              <div>
                <h4 class="mb-0">{{ $statusCounts['Disetujui'] }}</h4>
                <p class="mb-0">Surat Disetujui</p>
              </div>
              <span class="avatar p-2 me-lg-6">
                <span class="avatar-initial rounded bg-label-success">
                  <i class="icon-base ti tabler-checks icon-26px"></i>
                </span>
              </span>
            </div>
            <hr class="d-none d-sm-block d-lg-none" />
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <h4 class="mb-0">{{ $statusCounts['Ditolak'] }}</h4>
                <p class="mb-0">Surat Ditolak</p>
              </div>
              <span class="avatar p-2">
                <span class="avatar-initial rounded bg-label-danger">
                  <i class="icon-base ti tabler-alert-octagon icon-26px"></i>
                </span>
              </span>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div
              class="d-flex justify-content-between align-items-start border-end pb-4 pb-sm-0 card-widget-3">
              <div>
                <h4 class="mb-0">{{ $statusCounts['Selesai'] }}</h4>
                <p class="mb-0">Surat Selesai</p>
              </div>
              <span class="avatar p-2 me-sm-6">
                <span class="avatar-initial rounded bg-label-primary">
                  <i class="icon-base ti tabler-file icon-26px"></i>
                </span>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>


<!-- DataTable with Buttons -->
<div class="card">
    <div class="card-header border-bottom">
      <h5 class="card-title">Data Surat Pengambilan</h5>
      <div class="d-flex justify-content-between align-items-center row pt-4 gap-6 gap-md-0 g-md-6">
        <div class="col-md-4 filter_status"></div>
      </div>
    </div>
    <div class="card-datatable">
      <table class="datatables-products table">
        <thead class="border-top">
          <tr>
            <th>No Surat</th>
            <th>Nama Barang</th>
            <th>Link Surat</th>
            <th>Tanggal</th>
            <th>Status</th>
          </tr>
        </thead>
      </table>
    </div>
</div>
<!-- / Content -->

<!-- Modal Tambah Surat Pengambilan -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-6">
                    <h4 class="mb-2">Formulir Surat Pengambilan</h4>
                    <p>Lengkapi data berikut untuk proses pengadaan barangi</p>
                </div>
                <form id="editUserForm" class="row g-6" onsubmit="return false" enctype="multipart/form-data">
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="suratKode">Kode Surat</label>
                        <input
                            type="text"
                            id="suratKode"
                            name="suratKode"
                            class="form-control"
                            value="{{ $noSurat }}"
                            readonly
                            disabled />
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="idPengambilan">ID Pengambilan</label>
                        <input
                            type="text"
                            id="idPengambilan"
                            name="idPengambilan"
                            class="form-control"
                            value="{{ $idPengambilan }}"
                            readonly
                            disabled/>
                    </div>
                    <div class="col-12">
                        <label for="barangNama" class="form-label">Pilih Barang</label>
                        <select id="barangNama" class="select2 form-select" name="barang_id">
                            <option value="">Pilih Barang</option>
                            @foreach ($barangs as $barang)
                                <option value="{{ $barang->id }}" data-nama="{{ $barang->nama_barang }}" data-idbarang="{{ $barang->ID_barang }}">
                                    [{{ $barang->ID_barang }}] {{ $barang->nama_barang }} - Stok: {{ $barang->jumlah }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="barangJumlah">Jumlah</label>
                        <input
                            type="numeric"
                            id="barangJumlah"
                            name="barangJumlah"
                            class="form-control"
                            placeholder=""
                            value="" />
                    </div>
                    <div class="d-flex justify-content-end">
                          <button type="button" class="btn btn-sm btn-label-primary" data-repeater-create>
                            <i class="icon-base ti tabler-plus icon-xs me-1_5"></i>Tambah Item
                          </button>
                    </div>
                    <!-- Bordered Table -->
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered" id="dataTable">
                            <thead>
                                <tr>
                                    <th>ID Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Baris akan ditambahkan disini -->
                            </tbody>
                        </table>
                    </div>
                    <!--/ Bordered Table -->
                    <div class="col-12">
                        <label class="form-label" for="tujuanBarang">Tujuan Barang Digunakan</label>
                        <input
                            type="text"
                            id="tujuanBarang"
                            name="tujuanBarang"
                            class="form-control"
                            placeholder=""
                            value="" />
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-3">Simpan</button>
                        <button
                            type="reset"
                            class="btn btn-label-secondary"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                            Keluar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/ Modal Tambah Surat Pengambilan -->



<script>
    document.addEventListener('DOMContentLoaded', function (e) {
    let borderColor, bodyBg, headingColor;

    borderColor = config.colors.borderColor;
    bodyBg = config.colors.bodyBg;
    headingColor = config.colors.headingColor;

    // Variable declaration for table
    const dt_product_table = document.querySelector('.datatables-products'),
        statusObj = {
        1: { title: 'Diproses', class: 'bg-label-warning' },
        2: { title: 'Disetujui', class: 'bg-label-success' },
        3: { title: 'Ditolak', class: 'bg-label-danger' }
        };

    if (dt_product_table) {
        var dt_products = new DataTable(dt_product_table, {
            processing: true,
            serverSide: true,
            ajax: '{{ route("surat-pengambilan.show") }}',
            columns: [
                { data: 'no_surat', name: 'no_surat' },
                { data: 'nama_barang', name: 'nama_barang' },
                { data: 'link_surat', name: 'link_surat' },
                { data: 'created_at', name: 'created_at' },
                { data: 'status', name: 'status' }
            ],
            columnDefs: [
        {
            targets: 4,
            render: function (data, type, full, meta) {
                const statusClass = {
                    Diproses: 'bg-warning',
                    Disetujui: 'bg-success',
                    Ditolak: 'bg-danger'
                };

                const status = full['status'];
                return '<span class="badge ' + (statusClass[status] || 'bg-secondary') + '">' + status + '</span>';
            }
        },
        {
            targets: 3,
            render: function (data, type, full, meta) {
                const tanggal = new Date(full['created_at']);
                return tanggal.toLocaleDateString('id-ID');
            }
        }
    ],
        select: {
            style: 'multi',
            selector: 'td:nth-child(2)'
        },
        order: [0, 'asc'],
        displayLength: 7,
        layout: {
            topStart: {
            rowClass: 'card-header d-flex border-top rounded-0 flex-wrap py-0 flex-column flex-md-row align-items-start',
            features: [
                {
                search: {
                    className: 'me-5 ms-n4 pe-5 mb-n6 mb-md-0',
                    placeholder: 'Cari Surat',
                    text: '_INPUT_'
                }
                }
            ]
            },
            topEnd: {
            rowClass: 'row m-3 my-0 justify-content-between',
            features: [
                {
                pageLength: {
                    menu: [7, 10, 25, 50, 100],
                    text: '_MENU_'
                },
                buttons: [
                    {
                    extend: 'collection',
                    className: 'btn btn-label-secondary dropdown-toggle me-4',
                    text: '<span class="d-flex align-items-center gap-1"><i class="icon-base ti tabler-upload icon-xs"></i> <span class="d-none d-sm-inline-block">Export</span></span>',
                    buttons: [
                        {
                        extend: 'print',
                        text: `<span class="d-flex align-items-center"><i class="icon-base ti tabler-printer me-1"></i>Print</span>`,
                        className: 'dropdown-item',
                        exportOptions: {
                            columns: [0,1,2,3,4],
                            format: {
                            body: function (inner, coldex, rowdex) {
                                if (inner.length <= 0) return inner;

                                // Check if inner is HTML content
                                if (inner.indexOf('<') > -1) {
                                const parser = new DOMParser();
                                const doc = parser.parseFromString(inner, 'text/html');

                                // Get all text content
                                let text = '';

                                // Handle specific elements
                                const userNameElements = doc.querySelectorAll('.product-name');
                                if (userNameElements.length > 0) {
                                    userNameElements.forEach(el => {
                                    // Get text from nested structure
                                    const nameText =
                                        el.querySelector('.fw-medium')?.textContent ||
                                        el.querySelector('.d-block')?.textContent ||
                                        el.textContent;
                                    text += nameText.trim() + ' ';
                                    });
                                } else {
                                    // Get regular text content
                                    text = doc.body.textContent || doc.body.innerText;
                                }

                                return text.trim();
                                }

                                return inner;
                            }
                            }
                        },
                        customize: function (win) {
                            win.document.body.style.color = config.colors.headingColor;
                            win.document.body.style.borderColor = config.colors.borderColor;
                            win.document.body.style.backgroundColor = config.colors.bodyBg;
                            const table = win.document.body.querySelector('table');
                            table.classList.add('compact');
                            table.style.color = 'inherit';
                            table.style.borderColor = 'inherit';
                            table.style.backgroundColor = 'inherit';
                        }
                        },
                        {
                        extend: 'csv',
                        text: `<span class="d-flex align-items-center"><i class="icon-base ti tabler-file-text me-1"></i>Csv</span>`,
                        className: 'dropdown-item',
                        exportOptions: {
                            columns: [0,1,2,3,4],
                            format: {
                            body: function (inner, coldex, rowdex) {
                                if (inner.length <= 0) return inner;

                                // Parse HTML content
                                const parser = new DOMParser();
                                const doc = parser.parseFromString(inner, 'text/html');

                                let text = '';

                                // Handle user-name elements specifically
                                const userNameElements = doc.querySelectorAll('.user-name');
                                if (userNameElements.length > 0) {
                                userNameElements.forEach(el => {
                                    // Get text from nested structure - try different selectors
                                    const nameText =
                                    el.querySelector('.fw-medium')?.textContent ||
                                    el.querySelector('.d-block')?.textContent ||
                                    el.textContent;
                                    text += nameText.trim() + ' ';
                                });
                                } else {
                                // Handle other elements (status, role, etc)
                                text = doc.body.textContent || doc.body.innerText;
                                }

                                return text.trim();
                            }
                            }
                        }
                        },
                        {
                        extend: 'excel',
                        text: `<span class="d-flex align-items-center"><i class="icon-base ti tabler-upload me-1"></i>Excel</span>`,
                        className: 'dropdown-item',
                        exportOptions: {
                            columns: [0,1,2,3,4],
                            format: {
                            body: function (inner, coldex, rowdex) {
                                if (inner.length <= 0) return inner;

                                const parser = new DOMParser();
                                const doc = parser.parseFromString(inner, 'text/html');

                                let text = '';
                                const userNameElements = doc.querySelectorAll('.product-name');
                                if (userNameElements.length > 0) {
                                userNameElements.forEach(el => {
                                    const nameText =
                                    el.querySelector('.fw-medium')?.textContent ||
                                    el.querySelector('.d-block')?.textContent ||
                                    el.textContent;
                                    text += nameText.trim() + ' ';
                                });
                                } else {
                                text = doc.body.textContent || doc.body.innerText;
                                }

                                return text.trim();
                            }
                            }
                        }
                        }
                    ]
                    },
                    {
                    text: '<span class="d-flex align-items-center gap-2"><i class="icon-base ti tabler-plus icon-sm"></i> <span class="d-none d-sm-inline-block">Tambah Data</span></span>',
                    className: 'add-new btn btn-primary',
                    action: function () {
                        $('#addProductModal').modal('show');
                    }
                    }
                ]
                }
            ]
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
        },
        initComplete: function () {
            const api = this.api();

            api.columns(4).every(function () {
                const column = this;
                const select = document.createElement('select');
                select.className = 'form-select';
                select.innerHTML = '<option value="">Status</option>';

                document.querySelector('.filter_status').appendChild(select);

                select.addEventListener('change', function () {
                    const val = select.value ? `^${select.value}$` : '';
                    column.search(val, true, false).draw();
                });

                const uniqueStatuses = new Set();

                column
                    .data()
                    .each(function (d) {
                        const statusText = d; // GANTI BAGIAN INI
                        if (!uniqueStatuses.has(statusText)) {
                            uniqueStatuses.add(statusText);
                            const option = document.createElement('option');
                            option.value = statusText;
                            option.textContent = statusText;
                            select.appendChild(option);
                        }
                    });
            });
        }

        });
    }

    setTimeout(() => {
        const elementsToModify = [
        { selector: '.dt-buttons .btn', classToRemove: 'btn-secondary' },
        { selector: '.dt-buttons.btn-group', classToAdd: 'mb-md-0 mb-6' },
        { selector: '.dt-search .form-control', classToRemove: 'form-control-sm', classToAdd: 'ms-0' },
        { selector: '.dt-search', classToAdd: 'mb-0 mb-md-6' },
        { selector: '.dt-length .form-select', classToRemove: 'form-select-sm' },
        { selector: '.dt-layout-end', classToAdd: 'gap-md-2 gap-0 mt-0' },
        { selector: '.dt-layout-start', classToAdd: 'mt-0' },
        { selector: '.dt-layout-table', classToRemove: 'row mt-2' },
        { selector: '.dt-layout-full', classToRemove: 'col-md col-12', classToAdd: 'table-responsive' }
        ];

        // Delete record
        elementsToModify.forEach(({ selector, classToRemove, classToAdd }) => {
        document.querySelectorAll(selector).forEach(element => {
            if (classToRemove) {
            classToRemove.split(' ').forEach(className => element.classList.remove(className));
            }
            if (classToAdd) {
            classToAdd.split(' ').forEach(className => element.classList.add(className));
            }
        });
        });
    }, 100);
    });
</script>



<script>
    let itemList = [];

    document.querySelector('[data-repeater-create]').addEventListener('click', () => {
        const select = document.getElementById('barangNama');
        const selectedOption = select.options[select.selectedIndex];

        const id = selectedOption ? selectedOption.getAttribute('data-idbarang') : '';
        const nama = selectedOption ? selectedOption.getAttribute('data-nama') : '';
        const jumlah = document.getElementById('barangJumlah').value;

        if (!id || !nama || !jumlah) {
            alert("ID, Nama, dan Jumlah harus diisi.");
            return;
        }

        if (isNaN(jumlah) || parseInt(jumlah) <= 0) {
            alert("Jumlah harus berupa angka positif.");
            return;
        }

        // Cek duplikat: apakah id sudah ada di itemList?
        if (itemList.find(item => item.ID_barang === id)) {
            alert("Barang sudah ditambahkan.");
            return;
        }

        const item = { ID_barang: id, nama_barang: nama, jumlah: parseInt(jumlah) };
        itemList.push(item);

        const row = `
            <tr data-id="${id}">
                <td>${id}</td>
                <td>${nama}</td>
                <td>${jumlah}</td>
                <td><button type="button" class="btn btn-icon btn-text-secondary btn-hapus"><i class="icon-base ti tabler-trash icon-22px"></i></button></td>
            </tr>`;
        document.querySelector('#dataTable tbody').insertAdjacentHTML('beforeend', row);

        // Hapus opsi yang sudah dipilih supaya gak bisa dipilih lagi
        for(let i = 0; i < select.options.length; i++) {
            if(select.options[i].getAttribute('data-idbarang') === id) {
                select.remove(i);
                break;
            }
        }

        // Reset select2 dan jumlah
        $('#barangNama').val(null).trigger('change');
        $('#barangJumlah').val('');
    });

    // Hapus item dan kembalikan opsi ke select
    document.querySelector('#dataTable tbody').addEventListener('click', (e) => {
        if (e.target.classList.contains('btn-hapus') || e.target.closest('.btn-hapus')) {
            const row = e.target.closest('tr');
            const id = row.getAttribute('data-id');

            // Hapus dari itemList
            itemList = itemList.filter(item => item.ID_barang !== id);

            // Tambahkan kembali opsi ke select
            let select = document.getElementById('barangNama');
            let optionExists = false;
            for(let i = 0; i < select.options.length; i++) {
                if(select.options[i].getAttribute('data-idbarang') === id) {
                    optionExists = true;
                    break;
                }
            }
            if (!optionExists) {
                // Dapatkan nama dari row sebelum dihapus
                const nama = row.children[1].textContent;
                const option = document.createElement('option');
                option.value = id; // Untuk value, bisa sesuaikan dengan yang dipakai
                option.setAttribute('data-idbarang', id);
                option.setAttribute('data-nama', nama);
                option.text = `[${id}] ${nama}`; // Tampilannya bisa disesuaikan
                select.appendChild(option);
            }

            row.remove();
            $('#barangNama').trigger('change');
        }
    });

</script>


<script>
        // Simpan data
    document.getElementById('editUserForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData();
    formData.append('no_surat', document.getElementById('suratKode').value);
    formData.append('idPengambilan', document.getElementById('idPengambilan').value);
    formData.append('tujuan', document.getElementById('tujuanBarang').value);

    itemList.forEach((item, index) => {
        formData.append(`items[${index}][ID_barang]`, item.ID_barang);
        formData.append(`items[${index}][nama_barang]`, item.nama_barang);
        formData.append(`items[${index}][jumlah]`, item.jumlah);
    });

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('surat-pengambilan/store', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        body: formData
    })
    .then(response => response.json())
        .then(result => {
            Notiflix.Report.success(
                'Data berhasil disimpan!',
                'Data kamu sekarang sudah tercatat di sistem. <br/><br/>Silahkan cek kembali!',
                'Oke',
                function () {
                    window.location.reload();
                }
            );
        })
        .catch(error => {
            console.error('Error:', error);
            Notiflix.Report.failure(
                'Gagal menyimpan data.',
                `Ups! Terjadi kesalahan saat menyimpan data <br/><br/>Error: ${error.message || error}`,
                'Oke',
            );
        });
    });
</script>


@push('scripts')
<script>
    $('#addProductModal').on('shown.bs.modal', function () {
    if ($('#barangNama').hasClass("select2-hidden-accessible")) {
        $('#barangNama').select2('destroy');
    }
    $('#barangNama').select2({
        dropdownParent: $('#addProductModal')
    });
    });

</script>
@endpush


@endsection
