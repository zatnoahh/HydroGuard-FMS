<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>AdminLTE 4 | Sidebar Mini</title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="AdminLTE 4 | Sidebar Mini" />
    <meta name="author" content="ColorlibHQ" />
    <meta
      name="description"
      content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS."
    />
    <meta
      name="keywords"
      content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard"
    />
    <!--end::Primary Meta Tags-->
    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
    />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
      integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="../../../dist/css/adminlte.css" />
    <!--end::Required Plugin(AdminLTE)-->

    <!-- Style -->
    <style>
          body {
              background: url('../../dist/background.png') no-repeat center center fixed;
              background-size: cover;
          }
          /* Action Buttons */
      .action-btn {
          width: 32px;
          height: 32px;
          display: inline-flex;
          align-items: center;
          justify-content: center;
          border-radius: 50%;
          padding: 0;
          transition: all 0.3s ease;
      }

      .action-btn:hover {
          transform: translateY(-2px);
          box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      }

      /* If using Font Awesome icons */
      .action-btn i {
          font-size: 14px;
      }

      /* Delete button specific style */
      .btn-danger {
          background-color: #f44336;
          border-color: #f44336;
      }

      .btn-danger:hover {
          background-color: #d32f2f;
          border-color: #d32f2f;
      }

      .header {
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1030;
        background-color: #fff; /* Set background color */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Optional: Add shadow for better visibility */
      }

      .bg-orange {
          background-color: #fd7e14 !important; /* Bootstrap's orange shade */
      }

      .card {
          border-radius: 0.5rem;
          border: none;
        }
      .card-header {
          border-bottom: none;
      }
      .bg-gradient-danger {
          background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
      }
      .bg-orange {
          background-color: #fd7e14;
      }

      /* Alert styel */
      /* Card Styling */
      .card {
          border-radius: 0.75rem;
          border: none;
      }
      .card-header {
          border-bottom: none;
      }
      .bg-gradient-primary {
          background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
      }
      
      /* Water Level Gauge */
      .water-level-gauge {
          position: relative;
          width: 180px;
          height: 180px;
          background-color: #f8f9fa;
          border-radius: 50%;
          overflow: hidden;
          box-shadow: inset 0 0 10px rgba(0,0,0,0.1);
          border: 8px solid #e9ecef;
      }
      .gauge-body {
          position: relative;
          width: 100%;
          height: 100%;
      }
      .gauge-fill {
          position: absolute;
          bottom: 0;
          left: 0;
          right: 0;
          background-color: #0d6efd;
          transition: height 0.5s ease, background-color 0.5s ease;
      }
      .safe-fill { background-color: #198754; }
      .warning-fill { background-color: #0dcaf0; }
      .alert-fill { background-color: #ffc107; }
      .danger-fill { background-color: #dc3545; }
      .gauge-value {
          position: absolute;
          top: 50%;
          left: 0;
          right: 0;
          transform: translateY(-50%);
          font-size: 2rem;
          font-weight: 700;
          text-align: center;
          color: #212529;
      }
      .gauge-threshold-markers {
          position: absolute;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          pointer-events: none;
      }
      .threshold-marker {
          position: absolute;
          left: 0;
          right: 0;
          height: 2px;
          background-color: rgba(0,0,0,0.7);
      }
      .warning-marker { background-color: #0dcaf0; }
      .alert-marker { background-color: #ffc107; }
      .danger-marker { background-color: #dc3545; }
      
      /* Connection Status */
      .pulse-dot {
          display: inline-block;
          width: 10px;
          height: 10px;
          border-radius: 50%;
          animation: pulse 2s infinite;
      }
      @keyframes pulse {
          0% { opacity: 1; }
          50% { opacity: 0.3; }
          100% { opacity: 1; }
      }
      
      /* Threshold Items */
      .threshold-dot {
          display: inline-block;
          width: 10px;
          height: 10px;
          border-radius: 50%;
      }
      
      /* Animations */
      .animate-pulse {
          animation: pulse 2s infinite;
      }  
      
    </style>
    <!-- End Style -->
  </head>
  <!--end::Head-->
  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg sidebar-mini sidebar-collapse bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
      @include('layouts.1header')
      <!--end::Header-->
      <!--begin::Sidebar-->
      @include('layouts.1sidebar')
      <!--end::Sidebar-->
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content-->
        @yield('content')
        <!--end::App Content-->
      </main>
      <!--end::App Main-->
      <!--begin::Footer-->
      @extends('layouts.1footer')
      <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
      integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ="
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="../../../dist/js/adminlte.js"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });
    </script>
    <!--end::OverlayScrollbars Configure-->
    <!--end::Script-->
  </body>
  <!--end::Body-->
</html>
