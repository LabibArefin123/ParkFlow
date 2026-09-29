<aside class="parkflow-sidebar" id="parkflowSidebar">
    @include('parkflow.partials.sidebar_part.part_1')
    <div class="parkflow-sidebar-scroll">
        {{-- Overview Part --}}
        @include('parkflow.partials.sidebar_part.part_2')
        {{-- Operations Part --}}
        @include('parkflow.partials.sidebar_part.part_3')
        {{-- Parking Module --}}
        @include('parkflow.partials.sidebar_part.part_4')
        {{-- Finance & Report Part --}}
        @include('parkflow.partials.sidebar_part.part_5')
        {{-- Administration Part --}}
        @include('parkflow.partials.sidebar_part.part_6')\
    </div>
    {{-- Footer Part --}}
    @include('parkflow.partials.sidebar_part.part_7')
</aside>
