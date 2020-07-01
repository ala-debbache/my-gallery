@if ($paginator->hasPages())
<ul class="pagination justify-content-end">
    @if ($paginator->onFirstPage())
        <li class="page-item disabled"><a class="page-link"><i class="ti-arrow-left fs-9 mr-4"></i>Previous</a></li>
    @else
        <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}"><i class="ti-arrow-left fs-9 mr-4"></i>Previous</a></li>
    @endif

    @if ($paginator->hasMorePages())
        <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}">Next<i class="ti-arrow-right fs-9 ml-4"></i></a></li>
    @else
        <li class="page-item disabled"><a class="page-link" href="#">Next<i class="ti-arrow-right fs-9 ml-4"></i></a></li>
    @endif
</ul>
@endif
