<div class="offcanvas-lg offcanvas-start border-0" tabindex="-1" id="offcanvas">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">
            laravel
        </h5>
        <a href="#" class="offcanvas-navbar-toggler border-0" data-bs-dismiss="offcanvas" aria-label="Close" data-bs-target="#offcanvas">
            <i class="bi bi-x-lg fs-5"></i>
        </a>
    </div>
    <div class="px-0 offcanvas-body flex-column justify-content-end">
        <a href="{{ route('internal.dashboard.index') }}" class="mx-3 mb-1 px-2 py-1 btn text-bg-hover-main-500 @if (Request::is('internal/dashboard/*')) text-bg-main-500 @endif d-flex align-items-center text-decoration-none">
            <div class="px-2">
                <i class="bi bi-kanban fs-5"></i>
            </div>
            <div class="pe-4">Dashboard</div>
        </a>
        <a href="{{ route('internal.dashboard.index') }}" class="mx-3 mb-1 px-2 py-1 btn text-bg-hover-main-500 @if (Request::is('internal/project/*')) text-bg-main-500 @endif d-flex align-items-center text-decoration-none">
            <div class="px-2">
                <i class="bi bi-bar-chart-steps fs-5"></i>
            </div>
            <div class="pe-4">Projects</div>
        </a>
        <a href="{{ route('internal.schedule.index') }}" class="mx-3 mb-1 px-2 py-1 btn text-bg-hover-main-500 @if (Request::is('internal/schedule/*')) text-bg-main-500 @endif d-flex align-items-center text-decoration-none">
            <div class="px-2">
                <i class="bi bi-calendar-week fs-5"></i>
            </div>
            <div class="pe-4">Schedules</div>
        </a>
        <a href="{{ route('internal.dashboard.index') }}" class="mx-3 mb-1 px-2 py-1 btn text-bg-hover-main-500 @if (Request::is('internal/expense/*')) text-bg-main-500 @endif d-flex align-items-center text-decoration-none">
            <div class="px-2">
                <i class="bi bi-coin fs-5"></i>
            </div>
            <div class="pe-4">Expenses</div>
        </a>
        <a href="{{ route('internal.dashboard.index') }}" class="mx-3 mb-1 px-2 py-1 btn text-bg-hover-main-500 @if (Request::is('internal/note/*')) text-bg-main-500 @endif d-flex align-items-center text-decoration-none">
            <div class="px-2">
                <i class="bi bi-journals fs-5"></i>
            </div>
            <div class="pe-4">Notes</div>
        </a>
    </div>
</div>
