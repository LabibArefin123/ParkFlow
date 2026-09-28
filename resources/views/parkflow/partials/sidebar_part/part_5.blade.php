 <div class="parkflow-sidebar-section">
     <div class="parkflow-sidebar-heading">Finance & Reports </div>
     <a href="{{ route('revenue.index') }}"
         class="parkflow-sidebar-link {{ request()->routeIs('revenue.index') ? 'active' : '' }}">
         <span class="parkflow-sidebar-icon">
             <i class="fa-solid fa-wallet"></i>
         </span>
         <span class="parkflow-sidebar-label"> Revenue </span>
     </a>

     <a href="{{ route('reports.index') }}"
         class="parkflow-sidebar-link {{ request()->routeIs('reports.index') ? 'active' : '' }}">
         <span class="parkflow-sidebar-icon">
             <i class="fa-solid fa-chart-column"></i>
         </span>
         <span class="parkflow-sidebar-label">Reports </span>
     </a>
 </div>
