@extends('admin.layouts.main')
@section('content')
    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-header border-bottom">
            <h5 class="card-title">Pelacakan Barang</h5>
            <div class="d-flex justify-content-between align-items-center row pt-4 gap-6 gap-md-0 g-md-6">
                <div class="col-md-4 filter_status"></div>
            </div>
        </div>
        <div class="card-datatable">
            <table class="datatables-products table">
                <thead class="border-top">
                    <tr>
                        <th>ID Pelacakan</th>
                        <th>Surat Terkait</th>
                        <th>Nama Barang</th>
                        <th>Tanggal</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- / Content -->

    <!-- Modal Tambah Pelacakan -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-edit-user">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-6">
                        <h4 class="mb-2">Formulir Pelacakan Barang</h4>
                        <p>Lengkapi data berikut untuk pendataan pelacakan barang</p>
                    </div>
                    <form id="editUserForm" class="row g-6" onsubmit="return false" enctype="multipart/form-data">
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="idPengadaan">ID Pelacakan</label>
                            <input type="text" id="idPengadaan" name="idPengadaan" class="form-control" value=""
                                readonly disabled />
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="idPengadaan">Tanggal</label>
                            <input type="date" id="idPengadaan" name="idPengadaan" class="form-control" value="" />
                        </div>
                        <div class="col-12">
                            <label for="barangNama" class="form-label">Pilih Surat Terkait</label>
                            <select id="barangNama" class="select2 form-select" name="barang_id">
                                <option value="">Pilih Surat Terkait</option>
                                <option value="1">001/LIB-Ex/III/2025</option>
                                <option value="2">002/LIB-Ex/III/2025</option>
                                <option value="3">003/LIB-Ex/III/2025</option>
                            </select>
                        </div>
                        <!-- Bordered Table -->
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>ID Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Ukuran Barang</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>BRG001</td>
                                        <td>Laptop ASUS</td>
                                        <td>14 inch</td>
                                        <td>2</td>
                                    </tr>
                                    <tr>
                                        <td>BRG002</td>
                                        <td>Meja Kantor</td>
                                        <td>120x60 cm</td>
                                        <td>5</td>
                                    </tr>
                                    <tr>
                                        <td>BRG003</td>
                                        <td>Kursi Ergonomis</td>
                                        <td>Standar</td>
                                        <td>10</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!--/ Bordered Table -->
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
    <!--/ Modal Tambah Pelacakan -->

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
                    ajax: assetsPath + 'json/DummyBackend/lacak_barang.json', // JSON file to add data
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'surat',
                            name: 'surat'
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'tanggal',
                            name: 'tanggal'
                        }
                    ],
                    columnDefs: [{
                        targets: 4,
                        searchable: false,
                        orderable: false,
                        render: function(data, type, full, meta) {
                            return `
                                    <div class="d-inline-block">
                                        <a href="javascript:;"class="btn btn-icon btn-text-secondary rounded-pill waves-effect delete-record"data-bs-toggle="tooltip"data-bs-placement="top"title="Lihat Detail">
                                            <i class="icon-base ti tabler-eye icon-22px"></i>
                                        </a>
                                    </div>
                                `;
                        }

                    }],
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
                            select.innerHTML = '<option value="">Surat Terkait</option>';
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
