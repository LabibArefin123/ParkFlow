 <form method="GET" action="{{ route('reports.index') }}" class="report-filter-card">
     <div class="report-filter-heading">
         <div class="filter-heading-icon">
             <i class="fa-solid fa-calendar-days"></i>
         </div>
         <div>
             <strong>Report Period</strong>
             <span>Select the period you want to analyze.</span>
         </div>
     </div>

     <div class="report-filter-fields">
         <div class="report-field">
             <label for="from">From Date</label>
             <div class="report-input">
                 <i class="fa-regular fa-calendar"></i>
                 <input type="date" id="from" name="from" value="{{ $from->format('Y-m-d') }}">
             </div>
         </div>

         <div class="report-field">
             <label for="to">To Date</label>
             <div class="report-input">
                 <i class="fa-regular fa-calendar"></i>
                 <input type="date" id="to" name="to" value="{{ $to->format('Y-m-d') }}">
             </div>
         </div>

         <div class="report-filter-buttons">
             <button type="submit" class="generate-report-btn">
                 <i class="fa-solid fa-chart-line"></i>
                 Generate Report
             </button>

             <a href="{{ route('reports.index') }}" class="reset-report-btn">
                 <i class="fa-solid fa-rotate-left"></i>
             </a>
         </div>
     </div>
 </form>
