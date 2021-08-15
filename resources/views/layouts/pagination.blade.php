<div class="paginations float-right  inline justify-content-center flex mb-3">
    <ul class="list-group list-group-horizontal">
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="list-group-item disabled"><a class="page-link">{{ $element }}</a>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="list-group-item active inline">{{ $page }}</li>
                    @else
                        <li class="list-group-item"><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
    </ul>
</div>
