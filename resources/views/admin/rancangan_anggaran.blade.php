@extends('admin.layouts.main')
@section('content')
    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-header border-bottom">
            <h5 class="card-title">Rancangan Anggaran Tahunan</h5>
            <div class="d-flex justify-content-between align-items-center row pt-4 gap-6 gap-md-0 g-md-6">
                <div class="col-md-4 filter_status"></div>
            </div>
        </div>
        <div class="card-datatable">
            <table class="datatables-products table">
                <thead class="border-top">
                    <tr>
                        {{-- <th>ID Barang</th> --}}
                        <th>ID Staf</th>
                        <th>Nama Staf</th>
                        <th>Email</th>
                        <th>Periode</th>
                        <th>Pemasukan</th>
                        <th>Pengeluaran</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- / Content -->

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
                    ajax: assetsPath + 'json/DummyBackend/anggaran.json', // JSON file to add data
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'periode',
                            name: 'periode'
                        },
                        {
                            data: 'pemasukan',
                            name: 'pemasukan'
                        },
                        {
                            data: 'pengeluaran',
                            name: 'pengeluaran'
                        }
                    ],
                    columnDefs: [{
                            targets: 4,
                            render: function(data, type, row) {
                                if (type === 'display' || type === 'filter') {
                                    return 'Rp ' + Number(data).toLocaleString('id-ID');
                                }
                                return data;
                            }
                        },
                        {
                            targets: 5,
                            render: function(data, type, row) {
                                if (type === 'display' || type === 'filter') {
                                    return 'Rp ' + Number(data).toLocaleString('id-ID');
                                }
                                return data;
                            }
                        },
                        {
                            targets: 6,
                            searchable: false,
                            orderable: false,
                            render: function(data, type, full, meta) {
                                return `
                                <div class="d-flex align-items-center gap-1">
                                    <a href="javascript:;" data-bs-toggle="tooltip" class="btn btn-icon btn-text-secondary rounded-pill waves-effect delete-record" data-bs-placement="top" title="Edit">
                                    <i class="icon-base ti tabler-edit icon-22px"></i>
                                    </a>
                                    <div class="d-inline-block">
                                    <button class="btn btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="icon-base ti tabler-eye icon-22px"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end m-0">
                                        <a href="#" class="dropdown-item update-status" data-id="${full.id}" data-status="Disetujui">Lihat Detail</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item update-status" data-id="${full.id}" data-status="Ditolak">Cetak PDF</a>
                                    </div>
                                    </div>
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
                                    placeholder: 'Cari Staf',
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
                                }
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
