@extends('frontend.layouts.main')
@section('title', $seo['title'] ?? '' )
@section('keywords', $seo['keywords']??'')
@section('description', $seo['description']??'')
@section('abstract', $seo['abstract']??'')
@section('image', $seo['image']??'')

@section('content')
    <div class="content-wrapper">
        <div class="main">
            @isset($breadcrumbs,$typeBreadcrumb)
                @include('frontend.components.breadcrumbs',[
                    'breadcrumbs'=>$breadcrumbs,
                    'type'=>$typeBreadcrumb,
                ])
            @endisset

            @if( isset($listSystem) && $listSystem->count()>0 )
            <div class="wrap-contact-front">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="contact-title">Hệ thống cửa hàng &amp; Trung tâm dịch vụ</h2>
                        </div>
                        
                        <div class="contact-info col-12 col-md-6 col-lg-4 offset-lg-2 offset-md-1">
                            @php
                                $i=0;
                                $j=0;
                            @endphp

                            @foreach( $listSystem as $item)
                                @php
                                    $i++;
                                @endphp
                                <input type="radio" data-id_address_city="{{ $item->id }}" class="radio_address" name="tabs" id="tab{{ $i }}" @if($loop->first) checked @endif>
                                <label for="tab{{ $i }}">{{ $item->name }}</label>
                            @endforeach
                            
                            @foreach( $listSystem as $item)
                                @php
                                    $j++;
                                @endphp
                                <div class="tab content{{$j}} mt-5">
                                    @foreach( $item->childs()->where('active',1)->orderBy('order')->latest()->get() as $itemChild)
                                    <div class="info-contact">
                                        <div class="address">
                                            <a class="select_address" href="javascript:;" data-id_address="{{ $itemChild->id }}">{{ $itemChild->value }}</a>
                                        </div>
                                        <div class="hotline">{{ $itemChild->slug }}</div>
                                    </div>
                                    @endforeach
                                </div>
                            @endforeach
                                                
                        </div>
                        <div class="contact-map col-12 col-md-6 col-lg-6">
                            <div id="maps">
                                @foreach( $listSystem as $item)
                                    @if($loop->first)
                                        @php
                                            $itemChild = $item->childs()->where('active',1)->orderBy('order')->latest()->first();
                                        @endphp
                                        
                                        {!! $itemChild->description !!}
                                    @endif
                                @endforeach
                            </div>
                            
                        </div>

                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <div class="modal fade in" id="modalAjax">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Chi tiết đơn hàng</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
             <div class="content" id="content">

             </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
@endsection
@section('js')
<script type="text/javascript">
    $(document).on('click', '.select_address',function(){
        let id_address = $(this).data('id_address');

        let urlRequest = window.location;

        urlRequest = urlRequest +'?'+'id_address'+'='+id_address ;

        if(id_address != ''){
            $.ajax({
                url: urlRequest,
                method:"GET",
    
                success:function(data){
          
                    $('#maps').html(data);
                }
            })   
        }
    });

    $(document).on('click', '.radio_address',function(){
        let id_address_city = $(this).data('id_address_city');

        let urlRequest = window.location;

        urlRequest = urlRequest+'?'+'id_address_city'+'='+id_address_city;

        if(id_address_city != ''){
            $.ajax({
                url: urlRequest,
                method:"GET",
    
                success:function(data){
          
                    $('#maps').html(data);
                }
            })   
        }
    });

    
</script>
@endsection
