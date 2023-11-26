@if ($paginator->hasPages())
    <nav aria-label="Page navigation example" style="display: flex">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">
                    <i class="far fa-long-arrow-left"></i>
                </a></li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item "><a class="page-link" href="#">2</a></li>
            <li class="page-item "><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">
                    <i class="far fa-long-arrow-right"></i>
                </a></li>
        </ul>
    </nav>
@endif
