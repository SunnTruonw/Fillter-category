<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Variant;
use Illuminate\Http\Request;
use App\Models\VariantValue;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Traits\DeleteRecordTrait;

class AdminVariantValueController extends Controller
{
    use DeleteRecordTrait;
    private $variantValue;
    public function __construct(VariantValue $variantValue)
    {
        $this->variantValue = $variantValue;
    }
    public function index()
    {
        $data = $this->variantValue->orderBy("created_at", "desc")->paginate(15);
        return view(
            "admin.pages.variant-value.list",
            [
                'data' => $data
            ]
        );
    }
    public function create(Request $request)
    {
        $variants = Variant::all();

        return view(
            "admin.pages.variant-value.add",
            [
                'request' => $request,
                'variants' => $variants
            ]
        );
    }
    public function store(Request $request)
    {

        $dataVariantValueCreate = [
            "value" => $request->input('value') ?? '',
            "variant_id" => $request->input('variant_id'),

        ];
        if ($this->variantValue->create($dataVariantValueCreate)) {
            return redirect()->route("admin.variant-value.index")->with("alert", "Thêm biến thể thành công");
        } else {
            return redirect()->route("admin.variant-value.create")->with("error", "Thêm biển thể không thành công");
        }
    }
    public function edit($id)
    {
        $variants = Variant::all();

        $data = $this->variantValue->find($id);
        return view("admin.pages.variant-value.edit", [
            'data' => $data,
            'variants' => $variants,
        ]);
    }
    public function update(Request $request, $id)
    {
        $this->variantValue->find($id)->update([
            'value' => $request->input('value') ?? '',
            "variant_id" => $request->input('variant_id'),

        ]);
        return redirect()->route("admin.variant-value.index")->with("alert", "Sửa biến thể thành công");
    }
    public function destroy($id)
    {
        return $this->deleteCategoryRecusiveTrait($this->variantValue, $id);
    }
}
