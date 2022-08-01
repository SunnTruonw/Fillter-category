<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ValidateEditProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (auth()->guard('admin')->check()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = request()->route()->parameter('id');

        $rule = [

            "masp" => [
                "required",
                "min:3",
                "max:250",
                Rule::unique("App\Models\Product", 'masp')->ignore($id),
            ],

            "price" => "nullable|numeric",
            "size" => "nullable|string|min:1|max:191",
            "sale" => "nullable|numeric",
            "file" => "nullable|file|max:5000",
            "file2" => "nullable|file|max:5000",
            "file3" => "nullable|string|min:1|max:191",

            // "hot"=>"required",
            // "pay"=>"required",
            // "number"=>"required",
            "warranty" => "nullable",
            // "view"=>"required",
            "order" => "nullable|numeric",
            "avatar_path" => "mimes:jpeg,jpg,png,svg,webp|nullable|file|max:3000",
            "image_path.*" => "mimes:jpeg,jpg,png,svg,webp|nullable|file|max:3000",
            "category_id" => 'exists:App\Models\CategoryProduct,id',
            "supplier_id" => 'nullable|exists:App\Models\Supplier,id',
            "active" => "required",
            //  "checkrobot"=>"accepted"
        ];
        $langConfig = config('languages.supported');
        $langDefault = config('languages.default');

        foreach ($langConfig as $key => $value) {
            $arrConlai = $langConfig;
            unset($arrConlai[$key]);
            $keyConlai = array_keys($arrConlai);
            $keyConlai = collect($keyConlai);

            $stringKey = $keyConlai->map(function ($item, $key) {
                return "slug_" . $item;
            });
            $stringKey = $stringKey->implode(', ');

            $idPro = request()->route()->parameter('id');
            $pro = \App\Models\Product::find($idPro)->translationsLanguage($key)->first();
            $id = optional($pro)->id;

            $rule['name_' . $key] = "required|min:3|max:250";
            $rule['slug_' . $key] = [
                "required",
                'different:' . $stringKey,
                Rule::unique("App\Models\ProductTranslation", 'slug')->ignore($id, 'id'),
            ];

            $rule['title_seo_' . $key] = "nullable|min:1|max:191";
            $rule['description_seo_' . $key] = "nullable|min:1|max:191";
            $rule['keyword_seo_' . $key] = "nullable|min:1|max:191";

            $rule['model_' . $key] = [
                "nullable",
                "min:1",
                "max:191",
            ];
            $rule['tinhtrang_' . $key] = [
                "nullable",
                "min:1",
                "max:191",
            ];
            $rule['baohanh_' . $key] = [
                "nullable",
                "min:1",
                "max:191",
            ];
            $rule['xuatsu_' . $key] = [
                "nullable",
                "min:1",
                "max:191",
            ];
        }

        // $priceOption = request()->input('priceOption') ?? [];
        // foreach ($priceOption as $key => $value) {
        //         $rule['priceOption.' . $key] = 'required_with:sizeOption.'. $key;
        //         $rule['sizeOption.' . $key] = 'required_with:priceOption.'. $key;
        // }
        // $priceOption = request()->input('priceOptionOld') ?? [];
        // foreach ($priceOption as $key => $value) {
        //         $rule['priceOptionOld.' . $key] = 'required_with:sizeOptionOld.'. $key;
        //         $rule['sizeOptionOld.' . $key] = 'required_with:priceOptionOld.'. $key;
        // }

        return $rule;
    }
    public function messages()
    {
        return [
            "masp.required" => "Mã sản phẩm là trường bắt buộc",
            "masp.min" => "Mã sản phẩm  > 3",
            "masp.max" => "Mã sản phẩm  < 250",
            "masp.unique" => "Mã sản phẩm  đã tồn tại",
            "name.required" => "Name product is required",
            "name.min" => "Name category > 3",
            "name.max" => "Name category < 250",
            "slug.required" => "slug product is required",
            "slug.unique" => "Mã sản phẩm  đã tồn tại",
            "price" => "price is required",
            // "sale" => "sale is required",
            // "hot"=>"hot is required",
            // "pay"=>"pay is required",
            // "number"=>"number is required",
            // "warranty" => "hot is required",
            // "view" => "hot is required",
            "avatar.mimes" => "avatar  in jpeg,jpg,png,svg,webp",
            "active.required" => "active  is required",
            "category_id" => "category_id k tồn tại",
            "checkrobot.accepted" => "checkrobot category is accepted",
        ];
    }
}
