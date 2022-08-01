
@if ($data->active==1)
    <a  class="btn btn-sm btn-danger lb-active-star" data-url="{{ route($routeActive,['id'=>$data->id]) }}">
        Đã duyệt
    </a>
@else
<a  class="btn btn-sm btn-warning lb-active-star" data-url="{{ route($routeActive,['id'=>$data->id]) }}">
    Duyệt
</a>
@endif
