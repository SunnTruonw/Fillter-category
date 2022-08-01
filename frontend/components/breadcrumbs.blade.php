<div class="text-left wrap-breadcrumbs">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">

                    <ul class="breadcrumb">
                        <li class="breadcrumbs-item">
                            <a href="{{ makeLink('home') }}">{{ __('home.home') }}</a>
                        </li>
                        @foreach ($breadcrumbs as $item)
                        @if ($loop->last)
                        <li class="breadcrumbs-item active"><a href="{{ makeLink($type,$item['id']??'',$item['slug']??'') }}" class="currentcat">{{ $item['name'] }}</a></li>
                        @else
                        <li class="breadcrumbs-item"><a href="{{ makeLink($type,$item['id']??'',$item['slug'])??'' }}" class="currentcat">{{ $item['name'] }}</a></li>
                        @endif
                        @endforeach
                    </ul>
            </div>
        </div>
    </div>
</div>
