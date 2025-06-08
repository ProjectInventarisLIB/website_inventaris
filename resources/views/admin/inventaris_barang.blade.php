@extends('admin.layouts.main')
@section('content')
    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-header border-bottom">
            <h5 class="card-title">Inventaris Barang</h5>
            <div class="d-flex justify-content-between align-items-center row pt-4 gap-6 gap-md-0 g-md-6">
                <div class="col-md-4 filter_status"></div>
            </div>
        </div>
        <div class="card-datatable">
            <table class="datatables-products table">
                <thead class="border-top">
                    <tr>
                        <th>Gambar</th>
                        <th>Kode barang</th>
                        <th>Nama Barang</th>
                        <th>Ukuran</th>
                        <th>Satuan</th>
                        <th>Jumlah</th>
                        <th>Tanggal</th>
                        <th>Harga</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- / Content -->

    <!-- Modal Tambah inventaris Data -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-edit-user">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-6">
                        <h4 class="mb-2">Formulir Inventaris Barang</h4>
                        <p>Lengkapi data berikut untuk pendataan inventaris barang</p>
                    </div>
                    <form id="editUserForm" class="row g-6" onsubmit="return false" enctype="multipart/form-data">
                        <div class="col-12">
                            <label class="form-label" for="idPengadaan">ID Pengadaan</label>
                            <input type="text" id="idPengadaan" name="idPengadaan" class="form-control" value=""
                                readonly disabled />
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="barangNama">Nama Barang</label>
                            <input type="text" id="barangNama" name="barangNama" class="form-control" placeholder=""
                                value="" />
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="barangDeskripsi">Ukuran Barang</label>
                            <input type="text" id="barangDeskripsi" name="barangDeskripsi" class="form-control"
                                placeholder="" value="" />
                        </div>
                        <div class="mb-4">
                            <label for="formFileMultiple" class="form-label">Foto Barang (opsional)</label>
                            <input class="form-control" type="file" id="formFileMultiple" accept="image/*"
                                name="lampiran[]" multiple />
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary me-3">Simpan</button>
                            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                aria-label="Close">
                                Keluar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Modal Tambah inventaris Data -->

    <script>
        let dt_products;

        document.addEventListener('DOMContentLoaded', function(e) {
            let borderColor, bodyBg, headingColor;

            borderColor = config.colors.borderColor;
            bodyBg = config.colors.bodyBg;
            headingColor = config.colors.headingColor;

            const dt_product_table = document.querySelector('.datatables-products');

            if (dt_product_table) {
                dt_products = new DataTable(dt_product_table, {
                    processing: true,
                    serverSide: false,
                    ajax: assetsPath + 'json/DummyBackend/inventaris_barang.json', // JSON file to add data
                    columns: [{
                            data: 'gambar',
                            name: 'gambar'
                        },
                        {
                            data: 'kode',
                            name: 'kode'
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'ukuran',
                            name: 'ukuran'
                        },
                        {
                            data: 'satuan',
                            name: 'satuan'
                        },
                        {
                            data: 'jumlah',
                            name: 'jumlah'
                        },
                        {
                            data: 'tanggal',
                            name: 'tanggal'
                        },
                        {
                            data: 'harga',
                            name: 'harga'
                        }
                    ],

                    columnDefs: [{
                            targets: 0,
                            render: function(data, type, row) {
                                let imageUrl = data ? `/storage/gambar/${data}` :
                                    '{{ asset('assets/img/default_barang.jpg') }}';
                                return `<a href="${imageUrl}" target="_blank">
                                        <img src="${imageUrl}" alt="Barang" width="60">
                                    </a>`;
                            }
                        },
                        {
                            targets: 7,
                            render: function(data, type, row) {
                                if (type === 'display' || type === 'filter') {
                                    return 'Rp ' + Number(data).toLocaleString('id-ID');
                                }
                                return data;
                            }
                        },
                        {
                            targets: 8,
                            searchable: false,
                            orderable: false,
                            render: function(data, type, full, meta) {
                                return `
                                    <div class="d-inline-block">
                                        <a href="javascript:;"class="btn btn-icon btn-text-secondary rounded-pill waves-effect delete-record"data-bs-toggle="tooltip"data-bs-placement="top"title="Edit">
                                            <i class="icon-base ti tabler-edit icon-22px"></i>
                                        </a>
                                        <a href="javascript:;"class="btn btn-icon btn-text-secondary rounded-pill waves-effect delete-record"data-bs-toggle="tooltip"data-bs-placement="top"title="Delete">
                                            <i class="icon-base ti tabler-trash icon-22px"></i>
                                        </a>
                                    </div>
                                `;
                            }

                        }
                    ],
                    order: [0, 'asc'],
                    displayLength: 7,
                    layout: {
                        topStart: {
                            rowClass: 'card-header d-flex border-top rounded-0 flex-wrap py-0 flex-column flex-md-row align-items-start',
                            features: [{
                                search: {
                                    className: 'me-5 ms-n4 pe-5 mb-n6 mb-md-0',
                                    placeholder: 'Cari Barang',
                                    text: '_INPUT_'
                                }
                            }]
                        },
                        topEnd: {
                            rowClass: 'row m-3 my-0 justify-content-between',
                            features: [{
                                pageLength: {
                                    menu: [7, 10, 25, 50, 100],
                                    text: '_MENU_'
                                },
                                buttons: [{
                                    text: '<span class="d-flex align-items-center gap-2"><i class="icon-base ti tabler-plus icon-sm"></i> <span class="d-none d-sm-inline-block">Tambah Data</span></span>',
                                    className: 'add-new btn btn-primary',
                                    action: function() {
                                        $('#addProductModal').modal('show');
                                    }


                                }]
                            }]
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
                    initComplete: function() {
                        const api = this.api();
                        api.columns(1).every(function() {
                            const column = this;
                            const select = document.createElement('select');
                            select.className = 'form-select';
                            select.innerHTML = '<option value="">Kode</option>';
                            document.querySelector('.filter_status').appendChild(select);

                            select.addEventListener('change', function() {
                                const val = select.value ? `^${select.value}$` : '';
                                column.search(val, true, false).draw();
                            });

                            const uniqueStatuses = new Set();
                            column
                                .data()
                                .each(function(d) {
                                    if (!uniqueStatuses.has(d)) {
                                        uniqueStatuses.add(d);
                                        const option = document.createElement('option');
                                        option.value = d;
                                        option.textContent = d;
                                        select.appendChild(option);
                                    }
                                });
                        });
                    }
                });
            }

            // Style fix after load
            setTimeout(() => {
                const elementsToModify = [{
                        selector: '.dt-buttons .btn',
                        classToRemove: 'btn-secondary'
                    },
                    {
                        selector: '.dt-buttons.btn-group',
                        classToAdd: 'mb-md-0 mb-6'
                    },
                    {
                        selector: '.dt-search .form-control',
                        classToRemove: 'form-control-sm',
                        classToAdd: 'ms-0'
                    },
                    {
                        selector: '.dt-search',
                        classToAdd: 'mb-0 mb-md-6'
                    },
                    {
                        selector: '.dt-length .form-select',
                        classToRemove: 'form-select-sm'
                    },
                    {
                        selector: '.dt-layout-end',
                        classToAdd: 'gap-md-2 gap-0 mt-0'
                    },
                    {
                        selector: '.dt-layout-start',
                        classToAdd: 'mt-0'
                    },
                    {
                        selector: '.dt-layout-table',
                        classToRemove: 'row mt-2'
                    },
                    {
                        selector: '.dt-layout-full',
                        classToRemove: 'col-md col-12',
                        classToAdd: 'table-responsive'
                    }
                ];

                elementsToModify.forEach(({
                    selector,
                    classToRemove,
                    classToAdd
                }) => {
                    document.querySelectorAll(selector).forEach(element => {
                        if (classToRemove) {
                            classToRemove.split(' ').forEach(className => element.classList
                                .remove(className));
                        }
                        if (classToAdd) {
                            classToAdd.split(' ').forEach(className => element.classList
                                .add(className));
                        }
                    });
                });
            }, 100);
        });
    </script>
@endsection
