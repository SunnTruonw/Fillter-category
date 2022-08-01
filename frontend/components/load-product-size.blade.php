@isset($data)

    @if($data)        

            @php
                $k = 0;
            @endphp

            @foreach($data->sizes()->orderBy('order')->get() as $item )

                @if($item->stock)
                    @php
                        $k++;
                    @endphp
                    <div data-value="{{ $item->size }}" class="swatch-element available">

                        <input id="size-{{ $item->id }}-{{ $item->size }}" type="radio" class="option_size" name="size" value="{{ $item->id }}" data-price="{{ $item->price }}" data-old_price="{{ $item->old_price }}" data-size_val="{{$item->size}}" @if($k == 1)checked @endif />
                        
                        <label title="{{ $item->size }}" for="size-{{ $item->id }}-{{ $item->size }}">
                            {{ $item->size }}
                        </label>
                        
                    </div>
                @else
                    <div data-value="{{ $item->size }}" class="swatch-element @if(!$item->stock) soldout @endif  available">

                        <input id="size-{{ $item->id }}-{{ $item->size }}" type="radio" name="size" value="{{ $item->id }}" data-price="{{ $item->price }}" data-old_price="{{ $item->old_price }}" data-size_val="{{$item->size}}"  />
                        
                        <label title="{{ $item->size }}" for="size-{{ $item->id }}-{{ $item->size }}">
                            {{ $item->size }}
                        </label>
                        
                    </div>

                @endif
            @endforeach

    @endif

@endisset
