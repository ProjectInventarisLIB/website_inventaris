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
    <li class="menu-item {{ Request::is('halaman_dashboard') ? 'active' : '' }}">
      <a href="{{ url('halaman_dashboard') }}" class="menu-link">
        <i class="menu-icon icon-base ti tabler-smart-home"></i>
        <div data-i18n="Halaman Utama">Halaman Utama</div>
      </a>
    </li>

    <!-- Pengambilan -->
    <li class="menu-header small">
      <span class="menu-header-text" data-i18n="Pengambilan">Pengambilan</span>
    </li>
    <li class="menu-item {{ Request::is('barang_tersedia') ? 'active' : '' }}">
      <a href="{{ url('barang_tersedia') }}" class="menu-link">
        <i class="menu-icon icon-base ti tabler-layout-board"></i>
        <div data-i18n="Barang Tersedia">Barang Tersedia</div>
      </a>
    </li>
    <li class="menu-item {{ Request::is('surat_pengambilan') ? 'active' : '' }}">
      <a href="{{ url('surat_pengambilan') }}" class="menu-link">
        <i class="menu-icon icon-base ti tabler-file-description"></i>
        <div data-i18n="Surat Pengambilan">Surat Pengambilan</div>
      </a>
    </li>

    <!-- Pengadaan -->
    <li class="menu-header small">
      <span class="menu-header-text" data-i18n="Pengadaan">Pengadaan</span>
    </li>
    <li class="menu-item {{ Request::is('surat_pengadaan') ? 'active' : '' }}">
      <a href="{{ url('surat_pengadaan') }}" class="menu-link">
        <i class="menu-icon icon-base ti tabler-file"></i>
        <div data-i18n="Surat Pengadaan">Surat Pengadaan</div>
      </a>
    </li>
    <li class="menu-item {{ Request::is('pengadaan_mendesak') ? 'active' : '' }}">
      <a href="{{ url('pengadaan_mendesak') }}" class="menu-link">
        <i class="menu-icon icon-base ti tabler-mail"></i>
        <div data-i18n="Pengadaan Mendesak">Pengadaan Mendesak</div>
      </a>
    </li>

    <!-- Ubah Status -->
    <li class="menu-header small">
      <span class="menu-header-text" data-i18n="Status">Status</span>
    </li>
    <li class="menu-item {{ Request::is('menu_admin') ? 'active' : '' }}">
      <a href="{{ url('menu_admin') }}" class="menu-link">
        <i class="menu-icon icon-base ti tabler-layout-navbar"></i>
        <div data-i18n="Menu Admin">Menu Admin</div>
      </a>
    </li>

    {{--
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon icon-base ti tabler-file-description"></i>
        <div data-i18n="Surat Permohonan">Surat Permohonan</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a href="app-ecommerce-dashboard.html" class="menu-link">
            <div data-i18n="Surat Pengambilan">Surat Pengambilan</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="app-ecommerce-referral.html" class="menu-link">
            <div data-i18n="Surat Pengadaan">Surat Pengadaan</div>
          </a>
        </li>
      </ul>
    </li>
    --}}
  </ul>
</aside>

