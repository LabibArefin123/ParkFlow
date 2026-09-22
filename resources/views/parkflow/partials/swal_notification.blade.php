@if(session('success'))
<script>
document.addEventListener('DOMContentLoaded',function(){
    ParkFlowNotify(
        'success',
        @json('Welcome back, '.(auth()->user()->name??'User')),
        @json(session('success'))
    );
});
</script>
@endif

@if(session('error'))
<script>
document.addEventListener('DOMContentLoaded',function(){
    ParkFlowNotify(
        'error',
        'Something went wrong',
        @json(session('error'))
    );
});
</script>
@endif

@if(session('warning'))
<script>
document.addEventListener('DOMContentLoaded',function(){
    ParkFlowNotify(
        'warning',
        'Please check',
        @json(session('warning'))
    );
});
</script>
@endif

@if(session('info'))
<script>
document.addEventListener('DOMContentLoaded',function(){
    ParkFlowNotify(
        'info',
        'ParkFlow Update',
        @json(session('info'))
    );
});
</script>
@endif