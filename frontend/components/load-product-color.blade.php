@if(isset($data) && $data)
        {{-- <a class="hrefImg" href="{{ asset($data->avatar_type) }}" data-lightbox="image">
            <i class="fas fa-expand-alt"></i>
            <img class="expandedImg" src="{{ asset($data->avatar_type) }}" alt="{{ $data->name }}">
        </a>
        @php
            $j = 0;
        @endphp
        <div class="list-small-image">
            <div class="pt-box autoplay5-product-detail-new">
                <div class="small-image column" data-hash="{{$j}}">
                    <img src="{{ asset($data->avatar_type) }}" alt="{{ asset($data->name) }}">
                </div>
                @foreach($data->images as $item)
                    @php
                        $j++;
                    @endphp
                <div class="small-image column" data-hash="{{$j}}">
                    <img src="{{ asset($item->image_path) }}" alt="{{ $data->name }}" data-image="{{ asset($item->image_path) }}">
                </div>
                @endforeach
            </div>
        </div> --}}

        {{--
        <div class="image-main active">
            <a>
                <img class="expandedImg" src="{{  asset($data->avatar_type) }}" alt="{{ $data->name }}">
            </a>
        </div>
        @php
            $j = 0;
        @endphp
        <div class="list-small-image thumbimageslide-slick">
            <div class="pt-box autoplay5-product-detail-new">
                <div class="small-image column">
                    <img src="{{ asset($data->avatar_type) }}" alt="{{ asset($data->name) }}">
                </div>
                @foreach($data->images as $item)
                @php
                    $j++;
                @endphp
                <div class="small-image column" data-hash="{{$j}}">
                    <img src="{{ asset($item->image_path) }}" alt="{{ $data->name }}" data-image="{{ asset($item->image_path) }}">
                </div>
                @endforeach
            </div>
        </div>
        --}}
        @php
            $j = 0;
        @endphp
        <div class="big-img-slider slider-for">
            <div class="big-img-item">
                <a href="javascript:;">
                    <img src="{{ asset($data->avatar_type) }}" alt="{{ asset($data->name) }}">
                </a>
            </div>
            @foreach($data->images as $item)
            @php
                $j++;
            @endphp
            <div class="big-img-item">
                <a href="javascript:;">
                    <img src="{{ asset($item->image_path) }}" alt="{{ $data->name }}">
                </a>
            </div>
            @endforeach
        </div>
        <div class="slider-nav slider-small-img">

            <div class="slider-small-img-item column">
                <img src="{{ asset($data->avatar_type) }}" alt="">
            </div>
            @foreach($data->images as $item)
            @php
                $j++;
            @endphp
                <div class="slider-small-img-item column">
                    <img src="{{ asset($item->image_path) }}" alt="{{ $data->name }}">
                </div>
            @endforeach
        </div>
        <script>
            $('.slider-for').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                fade: true,
                asNavFor: '.slider-nav',
                dots: true,

            });
            $('.slider-nav').slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                asNavFor: '.slider-for',
                focusOnSelect: true,
                arrows: true,
                vertical: false,

            });
        </script>
@endif