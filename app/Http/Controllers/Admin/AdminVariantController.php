<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Variant;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Traits\DeleteRecordTrait;

class AdminVariantController extends Controller
{
    use DeleteRecordTrait;
    private $variant;
    public function __construct(Variant $variant)
    {
        $this->variant = $variant;
    }
    public function index()
    {
        $data = $this->variant->orderBy("created_at", "desc")->paginate(15);
        return view(
            "admin.pages.variant.list",
            [
                'data' => $data
            ]
        );
    }
    public function create(Request $request)
    {
        return view(
            "admin.pages.variant.add",
            [
                'request' => $request
            ]
        );
    }
    public function store(Request $request)
    {

        $dataVariantCreate = [
            "name" => $request->input('name') ?? '',
        ];
        if ($this->variant->create($dataVariantCreate)) {
            return redirect()->route("admin.variant.index")->with("alert", "Thêm variant thành công");
        } else {
            return redirect()->route("admin.variant.create")->with("error", "Thêm variant không thành công");
        }
    }
    public function edit($id)
    {
        $data = $this->variant->find($id);
        return view("admin.pages.variant.edit", [
            'data' => $data
        ]);
    }
    public function update(Request $request, $id)
    {
        $this->variant->find($id)->update([
            'name' => $request->input('name') ?? '',
        ]);
        return redirect()->route("admin.variant.index")->with("alert", "Sửa variant thành công");
    }
    public function destroy($id)
    {
        return $this->deleteCategoryRecusiveTrait($this->variant, $id);
    }
}
