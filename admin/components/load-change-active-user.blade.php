<a  class="btn btn-sm {{$data->active==1?'btn-success':($data->active==2?'btn-danger':'btn-warning') }} {{$data->active==0?' lb-active-user':''}}" data-value="{{$data->active}}" data-type="{{$type?$type:''}}"  style="width:80px;">{{$data->active==1?'Active':($data->active==2?'Khóa':'Disable')}}</a>