 <div class="admin-modules">
     @foreach ($modules as $module)
         @if ($module['route'] === '#')
             <a href="#" class="admin-module">
             @else
                 <a href="{{ route($module['route']) }}" class="admin-module">
         @endif
         <div class="admin-module-top">
             <div class="admin-module-icon">
                 <i class="fa-solid {{ $module['icon'] }}"></i>
             </div>
             <div class="admin-module-count">{{ $module['count'] }} </div>
         </div>

         <h3>{{ $module['title'] }}</h3>
         <p> {{ $module['description'] }} </p>
         <div class="admin-module-footer">
             <span>Manage</span> <i class="fa-solid fa-arrow-right"></i>
         </div>
         </a>
     @endforeach
 </div>
