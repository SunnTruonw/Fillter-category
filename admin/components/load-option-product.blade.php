
<div class="item-price">
    <div class="box-content-price">
        <div class="form-group">
            <label class="control-label" for="">Giá</label>
            <input type="number" min="0" class="form-control  @error('priceOption') is-invalid  @enderror"  value="{{ old('priceOption') }}" name="priceOption[]" placeholder="Nhập giá">
            @error('priceOption')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="control-label" for="">Giá cũ</label>
            <input type="number" min="0" class="form-control  @error('old_priceOption') is-invalid  @enderror"  value="{{ old('old_priceOption') }}" name="old_priceOption[]" placeholder="Nhập giá cũ">
            @error('old_priceOption')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label class="control-label" for="">Số kg</label>
            <input type="text" class="form-control  @error('size') is-invalid  @enderror"  value="{{ old('size') }}" name="sizeOption[]" placeholder="Nhập số kg">
            @error('sizeOption')
            <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        
    </div>
    <div class="action">
        <a  class="btn btn-sm btn-danger deleteOptionProduct"><i class="far fa-trash-alt"></i></a>
    </div>
</div>
