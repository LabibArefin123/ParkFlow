 <div class="parkflow-sidebar-section">
     <div class="parkflow-sidebar-heading">Administration</div>
     <a href="{{ route('administration') }}"
         class="parkflow-sidebar-link {{ request()->routeIs('administration') ? 'active' : '' }}">
         <span class="parkflow-sidebar-icon">
             <i class="fa-solid fa-building-shield"></i>
         </span>
         <span class="parkflow-sidebar-label"> Administration</span>
     </a>

     <a href="{{ route('users.index') }}"
         class="parkflow-sidebar-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
         <span class="parkflow-sidebar-icon">
             <i class="fa-solid fa-user-group"></i>
         </span>
         <span class="parkflow-sidebar-label"> System Users </span>
     </a>

     <a href="{{ route('roles.index') }}"
         class="parkflow-sidebar-link {{ request()->routeIs('roles.*') ? 'active' : '' }}">
         <span class="parkflow-sidebar-icon">
             <i class="fa-solid fa-user-gear"></i>
         </span>
         <span class="parkflow-sidebar-label"> Roles </span>
     </a>

     <a href="{{ route('permissions.index') }}"
         class="parkflow-sidebar-link {{ request()->routeIs('permissions.*') ? 'active' : '' }}">
         <span class="parkflow-sidebar-icon">
             <i class="fa-solid fa-unlock-keyhole"></i>
         </span>

         <span class="parkflow-sidebar-label"> Permissions </span>
     </a>

     <a href="{{ url('/admin') }}" class="parkflow-sidebar-link">
         <span class="parkflow-sidebar-icon">
             <i class="fa-solid fa-gauge-high"></i>
         </span>

         <span class="parkflow-sidebar-label"> Admin Panel </span>
     </a>
 </div>
