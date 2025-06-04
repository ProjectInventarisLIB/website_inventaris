@extends('staf.layouts.main')
@section("content")

<!-- Jumlah Semua Data -->
<div class="row g-6">
    <div class="col-lg-3 col-sm-6">
        <div class="card card-border-shadow-primary h-100">
            <div class="card-body">
            <div class="d-flex align-items-center mb-2">
                <div class="avatar me-4">
                <span class="avatar-initial rounded bg-label-primary"
                    ><i class="icon-base ti tabler-packages icon-28px"></i
                ></span>
                </div>
                <h4 class="mb-0">{{ $barang }}</h4>
            </div>
            <p class="mb-1">Barang Tersedia</p>
            <p class="mb-0">
                <span class="text-heading fw-medium me-2 {{ $barangInfo['naik'] ? 'text-success' : 'text-danger' }}">
                    {{ $barangInfo['naik'] ? '+' : '-' }}{{ $barangInfo['persen'] }}%
                </span>
                <small class="text-body-secondary">dibanding minggu lalu</small>
            </p>
            </div>
        </div>
        </div>
        <div class="col-lg-3 col-sm-6">
        <div class="card card-border-shadow-warning h-100">
            <div class="card-body">
            <div class="d-flex align-items-center mb-2">
                <div class="avatar me-4">
                <span class="avatar-initial rounded bg-label-warning"
                    ><i class="icon-base ti tabler-mail-down icon-28px"></i
                ></span>
                </div>
                <h4 class="mb-0">{{ $pengambilan }}</h4>
            </div>
            <p class="mb-1">Data Pengambilan</p>
            <p class="mb-0">
                <span class="text-heading fw-medium me-2 {{ $pengambilanInfo['naik'] ? 'text-success' : 'text-danger' }}">
                    {{ $pengambilanInfo['naik'] ? '+' : '-' }}{{ $pengambilanInfo['persen'] }}%
                </span>
                <small class="text-body-secondary">dibanding minggu lalu</small>
            </p>
            </div>
        </div>
        </div>
        <div class="col-lg-3 col-sm-6">
        <div class="card card-border-shadow-danger h-100">
            <div class="card-body">
            <div class="d-flex align-items-center mb-2">
                <div class="avatar me-4">
                <span class="avatar-initial rounded bg-label-danger"
                    ><i class="icon-base ti tabler-mail-up icon-28px"></i
                ></span>
                </div>
                <h4 class="mb-0">{{ $pengadaan }}</h4>
            </div>
            <p class="mb-1">Data Pengadaan</p>
            <p class="mb-0">
                <span class="text-heading fw-medium me-2 {{ $pengadaanInfo['naik'] ? 'text-success' : 'text-danger' }}">
                    {{ $pengadaanInfo['naik'] ? '+' : '-' }}{{ $pengadaanInfo['persen'] }}%
                </span>
                <small class="text-body-secondary">dibanding minggu lalu</small>
            </p>
            </div>
        </div>
        </div>
        <div class="col-lg-3 col-sm-6">
        <div class="card card-border-shadow-info h-100">
            <div class="card-body">
            <div class="d-flex align-items-center mb-2">
                <div class="avatar me-4">
                <span class="avatar-initial rounded bg-label-info"
                    ><i class="icon-base ti tabler-clock-bolt icon-28px"></i
                ></span>
                </div>
                <h4 class="mb-0">{{ $pengadaanMendesak }}</h4>
            </div>
            <p class="mb-1">Data Pengadaan Mendesak</p>
            <p class="mb-0">
                <span class="text-heading fw-medium me-2 {{ $pengadaanMendesakInfo['naik'] ? 'text-success' : 'text-danger' }}">
                    {{ $pengadaanMendesakInfo['naik'] ? '+' : '-' }}{{ $pengadaanMendesakInfo['persen'] }}%
                </span>
                <small class="text-body-secondary">dibanding minggu lalu</small>
            </p>
        </div>
    </div>
</div>

    <!--Status Seluruh Permohonan -->
<div class="col-xxl-6">
    <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between">
            <div class="card-title mb-0">
                <h5 class="m-0 me-2">Status Seluruh Permohonan</h5>
            </div>
        </div>
    <div class="card-body">
        <div class="d-none d-lg-flex vehicles-progress-labels mb-6">
            <div class="vehicles-progress-label on-the-way-text text-center" style="width: 25%;">Diproses</div>
            <div class="vehicles-progress-label unloading-text text-center" style="width: 25%;">Disetujui</div>
            <div class="vehicles-progress-label loading-text text-center" style="width: 25%;">Ditolak</div>
            <div class="vehicles-progress-label waiting-text text-nowrap text-center" style="width: 25%;">Selesai</div>
        </div>
        <div
            class="vehicles-overview-progress progress rounded-3 mb-3 bg-transparent overflow-hidden"
            style="height: 46px"
            >
            <div
                class="progress-bar fw-medium text-start shadow-none bg-warning text-paper px-4 rounded-0"
                role="progressbar"
                style="width: 25%"
            >
                {{ $statuses['percentages']['Diproses'] }}%
            </div>

            <div
                class="progress-bar fw-medium text-start shadow-none bg-success px-4"
                role="progressbar"
                style="width: 25%"
            >
                {{ $statuses['percentages']['Disetujui'] }}%
            </div>

            <div
                class="progress-bar fw-medium text-start shadow-none bg-maroon px-2 px-sm-4"
                role="progressbar"
                style="width: 25%"
            >
                {{ $statuses['percentages']['Ditolak'] }}%
            </div>

            <div
                class="progress-bar bg-light fw-medium text-start shadow-none snackbar text-heading px-1 px-sm-3 rounded-0 px-lg-4"
                role="progressbar"
                style="width: 25%"
            >
                {{ $statuses['percentages']['Selesai'] }}%
            </div>
        </div>

        <div class="table-responsive">
            <table class="table card-table table-border-top-0 table-border-bottom-0">
            <tbody>
                <tr>
                <td class="w-50 ps-0">
                    <div class="d-flex justify-content-start align-items-center">
                    <div class="me-2">
                        <i class="icon-base ti tabler-clock icon-lg text-heading"></i>
                    </div>
                    <h6 class="mb-0 fw-normal">Diproses</h6>
                    </div>
                </td>
                <td class="text-end pe-0 text-nowrap"><h6 class="mb-0">{{ $statuses['counts']['Diproses'] }} Surat</h6></td>
                <td class="text-end pe-0"><span>{{ $statuses['percentages']['Diproses'] }}%</span></td>
                </tr>

                <tr>
                <td class="w-50 ps-0">
                    <div class="d-flex justify-content-start align-items-center">
                    <div class="me-2">
                        <i class="icon-base ti tabler-progress-check icon-lg text-heading"></i>
                    </div>
                    <h6 class="mb-0 fw-normal">Disetujui</h6>
                    </div>
                </td>
                <td class="text-end pe-0 text-nowrap"><h6 class="mb-0">{{ $statuses['counts']['Disetujui'] }} Surat</h6></td>
                <td class="text-end pe-0"><span>{{ $statuses['percentages']['Disetujui'] }}%</span></td>
                </tr>

                <tr>
                <td class="w-50 ps-0">
                    <div class="d-flex justify-content-start align-items-center">
                    <div class="me-2">
                        <i class="icon-base ti tabler-ban icon-lg text-heading"></i>
                    </div>
                    <h6 class="mb-0 fw-normal">Ditolak</h6>
                    </div>
                </td>
                <td class="text-end pe-0 text-nowrap"><h6 class="mb-0">{{ $statuses['counts']['Ditolak'] }} Surat</h6></td>
                <td class="text-end pe-0"><span>{{ $statuses['percentages']['Ditolak'] }}%</span></td>
                </tr>

                <tr>
                <td class="w-50 ps-0">
                    <div class="d-flex justify-content-start align-items-center">
                    <div class="me-2">
                        <i class="icon-base ti tabler-circle-check icon-lg text-heading"></i>
                    </div>
                    <h6 class="mb-0 fw-normal">Selesai</h6>
                    </div>
                </td>
                <td class="text-end pe-0 text-nowrap"><h6 class="mb-0">{{ $statuses['counts']['Selesai'] }} Surat</h6></td>
                <td class="text-end pe-0"><span>{{ $statuses['percentages']['Selesai'] }}%</span></td>
                </tr>
            </tbody>
            </table>
        </div>
        </div>
    </div>
</div>


<!-- Anggaran Staf -->

<div class="col-xxl-6 col-lg-7">
    <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between">
            <div class="card-title mb-0">
                <h5 class="m-0 me-2">Anggaran {{ Auth::user()->name }}</h5>
            </div>
        </div>
        <div class="card-body">
        <div id="deliveryExceptionsChart"></div>
        </div>
    </div>
    </div>
</div>


<script>
'use strict';

document.addEventListener('DOMContentLoaded', function (e) {
    let labelColor, headingColor, borderColor, legendColor, fontFamily;

    labelColor = config.colors.textMuted;
    headingColor = config.colors.headingColor;
    borderColor = config.colors.borderColor;
    legendColor = config.colors.bodyColor;
    fontFamily = config.fontFamily;

    // Chart Colors
    const chartColors = {
        donut: {
            series1: config.colors.success,
            series2: config.colors.danger
        }
    };
    const deliveryExceptionsChartE1 = document.querySelector('#deliveryExceptionsChart'),
        deliveryExceptionsChartConfig = {
        chart: {
            height: 320,
            parentHeightOffset: 0,
            type: 'donut'
        },
        labels: ['Pemasukan Anggaran', 'Pengeluaran Anggaran'],
        series: [{{ $anggaran['pemasukan'] ?? 0 }}, {{ $anggaran['pengeluaran'] ?? 0 }}],
        colors: [
            chartColors.donut.series1,
            chartColors.donut.series2,
        ],
        stroke: {
            width: 0
        },
        dataLabels: {
            enabled: false,
            formatter: function (val, opt) {
                return parseInt(val) + '%';
            }
        },
        legend: {
            show: true,
            position: 'bottom',
            offsetY: 15,
            markers: {
                width: 8,
                height: 8,
                offsetX: -3
            },
            itemMargin: {
                horizontal: 15,
                vertical: 8
            },
            fontSize: '13px',
            fontFamily: fontFamily,
            fontWeight: 400,
            labels: {
                colors: headingColor,
                useSeriesColors: false
            }
        },
        tooltip: {
            theme: 'dark'
        },
        grid: {
            padding: {
                top: 15
            }
        },
        plotOptions: {
            pie: {
                donut: {
                    size: '77%',
                    labels: {
                        show: true,
                        value: {
                            fontSize: '18px',
                            fontFamily: fontFamily,
                            color: headingColor,
                            fontWeight: 500,
                            offsetY: -20,
                            formatter: function (val) {
                                return 'Rp ' + parseInt(val).toLocaleString('id-ID');
                            }
                        },
                        name: {
                            offsetY: 30,
                            fontFamily: fontFamily
                        },
                        total: {
                            show: true,
                            fontSize: '15px',
                            fontFamily: fontFamily,
                            color: legendColor,
                            label: 'Sisa Anggaran',
                            formatter: function (w) {
                                return 'Rp ' + parseInt({{ $anggaran['sisa_anggaran'] ?? 0 }}).toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        },
        responsive: [
            {
                breakpoint: 420,
                options: {
                    chart: {
                        height: 360
                    }
                }
            }
        ]
    };
    if (typeof deliveryExceptionsChartE1 !== undefined && deliveryExceptionsChartE1 !== null) {
        const deliveryExceptionsChart = new ApexCharts(deliveryExceptionsChartE1, deliveryExceptionsChartConfig);
        deliveryExceptionsChart.render();
    }

    setTimeout(() => {
        const elementsToModify = [
            { selector: '.dt-layout-start', classToAdd: 'my-0' },
            { selector: '.dt-layout-end', classToAdd: 'my-0' },
            { selector: '.dt-layout-table', classToRemove: 'row mt-2', classToAdd: 'mt-n2' },
            { selector: '.dt-layout-full', classToRemove: 'col-md col-12', classToAdd: 'table-responsive' }
        ];
    }, 100);
});
</script>

@endsection
