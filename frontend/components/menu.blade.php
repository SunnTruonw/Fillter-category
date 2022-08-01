@php
   $i=1;
   if (!isset($limit)) {
     $limit=99;
   }

@endphp

{{-- <style>
    .active_menu{
        color: #fff;
	    background: #e8151b
    }
</style>
  <ul class="nav-main"> 
    <i class="fas fa-circle"></i>  
    --}}
    @foreach ($data as $value)


    <li class="nav-item {{ Request::url() == url($value['slug_full']) ? 'active_menu' : '' }}  @if ($loop->first&&$active) active @endif">
        <a href="{{ $value['slug_full'] }}"><span> {!!  $value['name']  !!}</span>
            @isset($value['childs'])
            @if (count($value['childs'])>0&&$limit>=$i+1)
            {!!  $icon_d??""  !!}
            @endif
            @endisset
        </a>
        @isset($value['childs'])
            @if (count($value['childs'])>0&&$limit>=$i+1)
                <ul class="nav-sub">
                    @foreach ($value['childs'] as $childValue)
                        @include('frontend.components.menu-child', ['childs' => $childValue])
                    @endforeach
                </ul>
            @endif
        @endisset
    </li>

    @endforeach
{{-- </ul> --}}





