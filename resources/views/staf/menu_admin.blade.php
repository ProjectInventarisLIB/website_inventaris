@extends('staf.layouts.main')
@section("content")


<!-- DataTable with Buttons -->
<div class="card">
    <div class="card-header border-bottom">
      <h5 class="card-title">Data Surat Pengadaan</h5>
      <div class="d-flex justify-content-between align-items-center row pt-4 gap-6 gap-md-0 g-md-6">
        <div class="col-md-4 filter_status"></div>
      </div>
    </div>
    <div class="card-datatable">
      <table class="datatables-products table">
        <thead class="border-top">
          <tr>
            {{-- <th>ID Barang</th> --}}
            <th>No Surat</th>
            <th>Nama Barang</th>
            <th>Total Harga</th>
            <th>Link Surat</th>
            <th>Tanggal</th>
            <th>Status</th>
          </tr>
        </thead>
      </table>
    </div>
</div>
<!-- / Content -->

<script>
    let dt_products;

    document.addEventListener('DOMContentLoaded', function (e) {
        let borderColor, bodyBg, headingColor;

        borderColor = config.colors.borderColor;
        bodyBg = config.colors.bodyBg;
        headingColor = config.colors.headingColor;

        const dt_product_table = document.querySelector('.datatables-products'),
            statusObj = {
                1: { title: 'Diproses', class: 'bg-label-warning' },
                2: { title: 'Disetujui', class: 'bg-label-success' },
                3: { title: 'Ditolak', class: 'bg-label-danger' }
            };

        if (dt_product_table) {
            dt_products = new DataTable(dt_product_table, {
                processing: true,
                serverSide: true,
                ajax: '{{ route("menu-admin.tampilkan") }}',
                columns: [
                    { data: 'no_surat', name: 'no_surat' },
                    { data: 'nama_barang', name: 'nama_barang' },
                    { data: 'total_harga', name: 'total_harga' },
                    { data: 'link_surat', name: 'link_surat' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'status', name: 'status' }
                ],
                columnDefs: [
                    {
                    targets: 2,
                    render: function(data, type, row) {
                        if(type === 'display' || type === 'filter') {
                        return 'Rp ' + Number(data).toLocaleString('id-ID');
                        }
                        return data;
                    }
                    },
                    {
                        targets: 5,
                        searchable: false,
                        orderable: false,
                        render: function (data, type, full, meta) {
                            return `
                                <div class="d-inline-block">
                                    <button class="btn btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="icon-base ti tabler-edit icon-22px"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end m-0">
                                        <a href="#" class="dropdown-item text-success update-status" data-id="${full.id}" data-status="Disetujui">Disetujui</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item text-danger update-status" data-id="${full.id}" data-status="Ditolak">Ditolak</a>
                                    </div>
                                </div>`;
                        }
                    },
                    {
                        targets: 4,
                        render: function (data, type, full, meta) {
                            const tanggal = new Date(full['created_at']);
                            return tanggal.toLocaleDateString('id-ID');
                        }
                    }
                ],
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
                                        text: '<span class="d-flex align-items-center gap-2"><i class="icon-base ti tabler-refresh icon-sm"></i> <span class="d-none d-sm-inline-block">Muat Ulang</span></span>',
                                        className: 'add-new btn btn-primary',
                                        action: function () {
                                            dt_products.ajax.reload();
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
                    api.columns(5).every(function () {
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

    // Event untuk update status
    document.addEventListener('click', function (e) {
        if (e.target.closest('.update-status')) {
            e.preventDefault();

            const el = e.target.closest('.update-status');
            const id = el.getAttribute('data-id');
            const status = el.getAttribute('data-status');

            if (!id || !status) return;
            if (!confirm('Yakin ingin mengubah status?')) return;

            fetch('{{ route("menu-admin.update-status") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ id, status })
            })
                .then(res => {
                    if (!res.ok) throw new Error('Gagal mengubah status');
                    return res.json();
                })
                .then(data => {
                    alert(data.message);
                    if (dt_products) dt_products.ajax.reload(null, false);
                })
                .catch(err => alert(err.message));
        }
    });
</script>



@endsection

