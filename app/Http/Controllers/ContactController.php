<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\Setting;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class ContactController extends Controller
{
    //
    private $setting;
    private $contact;
    public function __construct(Setting $setting, Contact $contact)
    {
        /*$this->middleware('auth');*/
        $this->setting=$setting;
        $this->contact=$contact;
    }
    public function index(){
        $resultCheckLang=checkRouteLanguage2();
        if($resultCheckLang){
            return $resultCheckLang;
        }


        $dataAddress=$this->setting->find(28);
        $map=$this->setting->find(33);
        $breadcrumbs= [
            [
                'name'=> __('home.lien_he'),
                'slug'=>makeLinkToLanguage('contact',null,null,\App::getLocale()),
            ],
        ];



        return view("frontend.pages.contact",[

            'breadcrumbs' => $breadcrumbs,
            'typeBreadcrumb' => 'contact',
            'title' =>  "title_lienhe",

            'seo' => [
                'title' => __('contact.title_lienhe'),
                'keywords' => __('contact.keywords_lienhe'),
                'description' => __('contact.description_lienhe'),
                'image' =>  "",
				'abstract' => __('contact.abstract_lienhe'),
            ],

            "dataAddress"=>$dataAddress,
            "map"=>$map,
        ]);
    }
    public function storeAjax(Request $request){
     //   dd($request->name);
    // dd($request->ajax());
         try {
             DB::beginTransaction();
            $title='THÔNG TIN LIÊN HỆ';
            $dataContactCreate = [
                'name' => $request->input('name')??"",
                'phone' => $request->input('phone')??"",
                'email' => $request->input('email')??"",
                'active' => $request->input('active')??1,
                'status' => 1,
                'city_id' => $request->input('city_id')??null,
                'district_id' => $request->input('district_id')??null,
                'commune_id' => $request->input('commune_id')??null,
                'address_detail' => $request->input('address_detail')??null,
                'content'=>($request->input('title')??$title).'<br />'.'Nội dung: '.$request->input('content'),
                'admin_id' => 0,
                'user_id' => Auth::check() ? Auth::user()->id : 0,
            ];
     
            // Giới tính: '.$request->input('sex').'<br>
            // Từ: '.$request->input('from').'<br>
            // Đến: '.$request->input('to').'<br>
            // Từ: '.$request->input('service').'<br>

            $contact = $this->contact->create($dataContactCreate);
          //  dd($contact);
            DB::commit();
            return response()->json([
            "code" => 200,
            "html" => 'Gửi thông tin thành công',
            "message" => "success"
            ], 200);

         } catch (\Exception $exception) {
             //throw $th;
             DB::rollBack();
             Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
             return response()->json([
                "code" => 500,
                'html'=>'Gửi thông tin không thành công',
                "message" => "fail"
            ], 500);

         }
    }

    public function storeAjax2(Request $request){

         try {
             DB::beginTransaction();
            $title='HẸN LỊCH NGAY';
            $dataContactCreate = [
                'name' => $request->input('name')??"",
                'phone' => $request->input('phone')??"",
                'email' => $request->input('email')??"",
                'active' => $request->input('active')??1,
                'status' => 1,
                'city_id' => $request->input('city_id')??null,
                'district_id' => $request->input('district_id')??null,
                'commune_id' => $request->input('commune_id')??null,
                'address_detail' => $request->input('address_detail')??null,
                'content'=>($request->input('title')??$title).'<br />'.'Nội dung: '.$request->input('content').'<br />'.'Ngày đến: '.Carbon::parse($request->input('date_start'))->format('d/m/Y')??'',
                'admin_id' => 0,
                'user_id' => Auth::check() ? Auth::user()->id : 0,
            ];
     
            // Giới tính: '.$request->input('sex').'<br>
            // Từ: '.$request->input('from').'<br>
            // Đến: '.$request->input('to').'<br>
            // Từ: '.$request->input('service').'<br>

            $contact = $this->contact->create($dataContactCreate);
          //  dd($contact);
            DB::commit();
            return response()->json([
            "code" => 200,
            "html" => 'Gửi thông tin thành công',
            "message" => "success"
            ], 200);

         } catch (\Exception $exception) {
             //throw $th;
             DB::rollBack();
             Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
             return response()->json([
                "code" => 500,
                'html'=>'Gửi thông tin không thành công',
                "message" => "fail"
            ], 500);

         }
    }

    public function storeAjax1(Request $request){

         try {
             DB::beginTransaction();
            $title='ĐĂNG KÝ NGAY';
            $dataContactCreate = [
                'name' => $request->input('name')??"",
                'phone' => $request->input('phone')??"",
                'email' => $request->input('email')??"",
                'active' => $request->input('active')??1,
                'status' => 1,
                'city_id' => $request->input('city_id')??null,
                'district_id' => $request->input('district_id')??null,
                'commune_id' => $request->input('commune_id')??null,
                'address_detail' => $request->input('address_detail')??null,
                'content'=>($request->input('title')??$title).'
                <br />'.'Nội dung: '.$request->input('content2').'
                <br />'.'Sản phẩm: '.$request->input('content')??'',
                'admin_id' => 0,
                'user_id' => Auth::check() ? Auth::user()->id : 0,
            ];
     
            // Giới tính: '.$request->input('sex').'<br>
            // Từ: '.$request->input('from').'<br>
            // Đến: '.$request->input('to').'<br>
            // Từ: '.$request->input('service').'<br>

            $contact = $this->contact->create($dataContactCreate);
          //  dd($contact);
            DB::commit();
            return response()->json([
            "code" => 200,
            "html" => 'Gửi thông tin thành công',
            "message" => "success"
            ], 200);

         } catch (\Exception $exception) {
             //throw $th;
             DB::rollBack();
             Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
             return response()->json([
                "code" => 500,
                'html'=>'Gửi thông tin không thành công',
                "message" => "fail"
            ], 500);

         }
    }
}
