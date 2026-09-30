<div class="report-period">
    <div>
        <i class="fa-solid fa-clock-rotate-left"></i>
        Report period
    </div>
    <strong>
        {{ $from->format('d M Y') }}
        <span>—</span>
        {{ $to->format('d M Y') }}
    </strong>
</div>
