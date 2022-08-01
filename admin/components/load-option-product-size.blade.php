<div class="item-price">
    <div class="box-content-price">
        <div class="form-group">
            <label class="control-label" for="">Nhập size</label>
            <input type="text" class="form-control autoplate_name  @error('valueOption') is-invalid  @enderror"  valueOption="{{ old('valueOption') }}" name="valueOption[]" placeholder="Nhập size">
            @error('valueOption')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror        
        </div>
        <div class="form-group">
            <label class="control-label" for="">Ẩn size (Hết size)</label>
            <div class="form-check-inline">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input @error('statusOption[]')
                        is-invalid
                        @enderror" value="0" name="statusOption[]" @if(old('statusOption')==="1" ) {{'checked'}} @endif>
                </label>
            </div>
            @error('statusOption[]')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        {{-- <div class="form-group">
            <label class="control-label" for="">Tình trạng</label>
            <div class="form-check-inline">
                <label class="form-check-label">
                <input type="radio" class="form-check-input" value="1" name="statusOption[]" @if(old('status')==='1' ||old('status')===null) {{'checked'}} @endif>Còn hàng
                </label>
            </div>
            <div class="form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="0" @if(old('status')==="0" ){{'checked'}} @endif name="statusOption[]">Hết
                </label>
            </div>
            @error('status')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div> --}}
        <div class="action">
            <a class="btn btn-sm btn-danger deleteOptionProductSize"><i class="far fa-trash-alt"></i></a>
        </div>
    </div>
    
</div>