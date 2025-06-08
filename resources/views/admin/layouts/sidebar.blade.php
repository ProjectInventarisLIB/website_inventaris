<aside id="layout-menu" class="layout-menu menu-vertical menu">
    <div class="app-brand demo">
        <a href="{{ url('halaman_dashboard') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <span class="text-primary">
                    <img src="{{ asset('assets/img/logo_gambar.png') }}" alt="Logo" height="40" />
                </span>
            </span>
            <span class="app-brand-logo demo ms-4">
                <span class="text-primary">
                    <img src="{{ asset('assets/img/logo_tulisan.png') }}" alt="Logotulisan" height="43" />
                </span>
            </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="icon-base ti menu-toggle-icon d-none d-xl-block"></i>
            <i class="icon-base ti tabler-x d-block d-xl-none"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item {{ Request::is('dashboard_admin') ? 'active' : '' }}">
            <a href="{{ url('dashboard_admin') }}" class="menu-link">
                <i class="menu-icon icon-base ti tabler-smart-home"></i>
                <div data-i18n="Halaman Utama">Halaman Utama</div>
            </a>
        </li>

        <!-- anggaran -->
        <li class="menu-item {{ Request::is('rancangan_anggaran') ? 'active' : '' }}">
            <a href="{{ url('rancangan_anggaran') }}" class="menu-link">
                <i class="menu-icon icon-base ti tabler-layout-board"></i>
                <div data-i18n="Anggaran Tahunan">Anggaran Tahunan</div>
            </a>
        </li>

        <!-- Inventory -->
        <li class="menu-header small">
            <span class="menu-header-text" data-i18n="Inventory">Inventory</span>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon icon-base ti tabler-file-description"></i>
                <div data-i18n="Master Data Gudang">Master Data Gudang</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="master_barang" class="menu-link">
                        <div data-i18n="Master Jenis Barang">Master Jenis Barang</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="lacak_barang" class="menu-link">
                        <div data-i18n="Lacak Barang Masuk">Lacak Barang Masuk</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="lacak_barang" class="menu-link">
                        <div data-i18n="Lacak Barang Keluar">Lacak Barang Keluar</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item {{ Request::is('inventaris_barang') ? 'active' : '' }}">
            <a href="{{ url('inventaris_barang') }}" class="menu-link">
                <i class="menu-icon icon-base ti tabler-file-description"></i>
                <div data-i18n="Inventaris Barang">Inventaris Barang</div>
            </a>
        </li>

        <!-- Permohonan -->
        <li class="menu-header small">
            <span class="menu-header-text" data-i18n="Permohonan">Permohonan</span>
        </li>
        <li class="menu-item {{ Request::is('surat_permohonan') ? 'active' : '' }}">
            <a href="{{ url('surat_permohonan') }}" class="menu-link">
                <i class="menu-icon icon-base ti tabler-mail"></i>
                <div data-i18n="Persetujuan Pengadaan">Persetujuan Pengadaan</div>
            </a>
        </li>

        <li class="menu-item {{ Request::is('surat_permohonan') ? 'active' : '' }}">
            <a href="{{ url('surat_permohonan') }}" class="menu-link">
                <i class="menu-icon icon-base ti tabler-mail"></i>
                <div data-i18n="Persetujuan Pengambilan">Persetujuan Pengambilan</div>
            </a>
        </li>


        <!-- Supplier -->
        <li class="menu-header small">
            <span class="menu-header-text" data-i18n="Supplier">Supplier</span>
        </li>
        <li class="menu-item {{ Request::is('data_vendor') ? 'active' : '' }}">
            <a href="{{ url('data_vendor') }}" class="menu-link">
                <i class="menu-icon icon-base ti tabler-layout-navbar"></i>
                <div data-i18n="Data Vendor">Data Vendor</div>
            </a>
        </li>

        <li class="menu-item {{ Request::is('order') ? 'active' : '' }}">
            <a href="{{ url('order') }}" class="menu-link">
                <i class="menu-icon icon-base ti tabler-layout-navbar"></i>
                <div data-i18n="Quotation Order">Quotation Order</div>
            </a>
        </li>

        <li class="menu-item {{ Request::is('order') ? 'active' : '' }}">
            <a href="{{ url('order') }}" class="menu-link">
                <i class="menu-icon icon-base ti tabler-layout-navbar"></i>
                <div data-i18n="Purchase Order">Purchase Order</div>
            </a>
        </li>

    </ul>
</aside>
