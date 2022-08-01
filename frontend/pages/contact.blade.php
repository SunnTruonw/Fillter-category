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

            <div class="wrap-content-main wrap-template-contact">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="contact-infor" style="background: #fff">
                                <div class="infor">
                                    @isset($dataAddress)
                                        <div class="address">
                                            <div class="footer-layer">
                                                <div class="title">
                                                {{ $dataAddress->value }}
                                                </div>
                                                <ul class="pt_list_addres">
                                                @foreach ($dataAddress->childs as $item)
                                                <li>{!! $item->slug !!} {{ $item->value }}</li>
                                                @endforeach

                                                </ul>
                                            </div>
                                        </div>
                                    @endisset
                                    @isset($map)
                                        <div class="map">
                                            {!! $map->description !!}
                                        </div>
                                    @endisset
                                </div>
                            </div>
                        </div>
						
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="contact-form" style="background: #fff; padding-top: 0px;">
                                <div class="form">
                                    <p>{{ __('contact.full_info') }}</p>
                                    <form  action="{{ route('contact.storeAjax') }}"  data-url="{{ route('contact.storeAjax') }}" data-ajax="submit" data-target="alert" data-href="#modalAjax" data-content="#content" data-method="POST" method="POST">
                                        @csrf
										<div class="row">
											<div class="col-md-6 col-sm-12 col-xs-12">
												<label>Họ tên <span>*</span></label>
												<input type="text" placeholder="{{ __('contact.name') }}" required="required" name="name">
											</div>
											<div class="col-md-6 col-sm-12 col-xs-12">
												<label>Điện thoại <span>*</span></label>
												<input type="text" placeholder="{{ __('contact.phone') }}" required="required" name="phone">
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12">
												<label>Nội dung tư vấn</label>
												<textarea name="content" placeholder="{{ __('contact.content') }}" id="noidung" cols="30" rows="5"></textarea>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12">
												<button class="hvr-float-shadow">{{ __('contact.send_info') }}</button>
											</div>
										</div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
    <script>

        // ajax load form
        $(document).on('submit',"[data-ajax='submit']",function(){
            let formValues = $(this).serialize();
            let dataInput=$(this).data();
            // dataInput= {content: "#content", href: "#modalAjax", target: "modal", ajax: "submit", url: "http://127.0.0.1:8000/contact/store-ajax"}

            $.ajax({
                type: dataInput.method,
                url: dataInput.url,
                data: formValues,
                dataType: "json",
                success: function (response) {
                    if(response.code==200){
                        if(dataInput.content){
                            $(dataInput.content).html(response.html);
                        }
                        if(dataInput.target){
                            switch (dataInput.target) {
                                case 'modal':
                                    $(dataInput.href).modal();
                                    break;
                                case 'alert':
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: response.html,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                default:
                                    break;
                            }
                        }
                    }else{
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: response.html,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }

                   // console.log( response.html);
                },
                error:function(response){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
            return false;
        });
    </script>
@endsection
