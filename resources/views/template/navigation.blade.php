<!--  BEGIN SIDEBAR  -->
<div class="sidebar-wrapper sidebar-theme">
    
  <nav id="sidebar">
    <div class="shadow-bottom"></div>

    <ul class="list-unstyled menu-categories" id="accordionExample">
      {{-- MENU ADMINISTRATOR --}}
      @if (Auth::user()->getRoleId() == 1) 
        <li class="menu">
          <a href="{{ route('admin.dashboard.index') }}" 
            {{ in_array(Route::currentRouteName(), ["admin.dashboard.index"]) ? "data-active=true" : "" }}
            aria-expanded="false" 
            class="dropdown-toggle"
            >
            <div class="">
              <i data-feather="home"></i>
              <span> Dashboard</span>
            </div>
          </a>
        </li>
        <li class="menu">
          <a href="{{ route('admin.admission.index') }}" 
            {{ in_array(Route::currentRouteName(), ["admin.admission.index"]) ? "data-active=true" : "" }}
            aria-expanded="false" 
            class="dropdown-toggle"
            >
            <div class="">
              <i data-feather="codesandbox"></i>
              <span> Pemasukan</span>
            </div>
          </a>
        </li>
        <li class="menu">
          <a href="{{ route('admin.admission.index') }}" 
            {{ in_array(Route::currentRouteName(), ["admin.admission.index"]) ? "data-active=true" : "" }}
            aria-expanded="false" 
            class="dropdown-toggle"
            >
            <div class="">
              <i data-feather="command"></i>
              <span> Pengeluaran</span> 
            </div>
          </a>
        </li>
      @endif
      {{-- END MENU ADMINISTRATOR --}}
    </ul>
      
  </nav>

</div>
<!--  END SIDEBAR  -->

@push("script")
  <script type="text/javascript">
    $(document).ready(function() {
    });
  </script>
@endpush