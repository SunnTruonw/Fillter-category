<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductStar;
use App\Traits\DeleteRecordTrait;
use PDF;
use App\Traits\PointTrait;

class AdminProductStarController extends Controller
{
    //
    use DeleteRecordTrait, PointTrait;
    private  $productstar;
    private $unit;
    private $listStatus;
    private $typePoint;
    private $rose;
    public function __construct(ProductStar $productstar)
    {
        $this->productstar = $productstar;
    }
    public function index(Request $request)
    {
        $productstars = $this->productstar;
        $where = [];
        $orWhere = null;
        if ($request->has('keyword') && $request->input('keyword')) {

            $productstars = $productstars->where(function ($query) {
                $query->where([
                    ['email', 'like', '%' . request()->input('keyword') . '%']
                ])->orWhere([
                    ['title', 'like', '%' . request()->input('keyword') . '%']
                ]);
            });
            // $where[] = ['name', 'like', '%' . $request->input('keyword') . '%'];
            // $orWhere = ['code', 'like', '%' . $request->input('keyword') . '%'];
        }
        if ($request->has('hot') && $request->input('hot')) {
            $where[] = ['hot', $request->input('hot')];
        }
        if ($where) {
            $productstars = $productstars->where($where);
        }
        if ($orWhere) {
            $productstars = $productstars->orWhere(...$orWhere);
        }
        $orderby = [];

        if ($request->has('order_with') && $request->input('order_with')) {
            $key = $request->input('order_with');
            switch ($key) {
                case 'dateASC':
                    $orderby[] = ['created_at'];
                    break;
                case 'dateDESC':
                    $orderby[] = [
                        'created_at',
                        'DESC'
                    ];
                    break;
                case 'statusASC':
                    $orderby[] = ['status', 'ASC'];
                    $orderby[] = ['created_at', 'DESC'];
                    break;
                case 'statusDESC':
                    $orderby[] = ['status', 'DESC'];
                    $orderby[] = [
                        'created_at',
                        'DESC'
                    ];
                    break;
                default:
                    $orderby[]  = [
                        'created_at',
                        'DESC'
                    ];
                    break;
            }
            foreach ($orderby as $or) {
                $productstars = $productstars->orderBy(...$or);
            }
        } else {
            $productstars = $productstars->orderBy("created_at", "DESC");
        }

        $productstars =  $productstars->paginate(15);
        return view('admin.pages.productstar.index', [
            'data' => $productstars,
            'keyword' => $request->input('keyword') ? $request->input('keyword') : "",
            'order_with' => $request->input('order_with') ? $request->input('order_with') : "",
            'statusCurrent' => $request->input('hot') ? $request->input('hot') : "",
        ]);
    }

    public function destroy($id)
    {
        return $this->deleteTrait($this->productstar, $id);
    }

    public function loadHot($id)
    {
        $productstar   =  $this->productstar->find($id);
        $active = $productstar->active;

        if ($active) {
            $activeUpdate = 0;
        } else {
            $activeUpdate = 1;
        }
        $updateResult =  $productstar->update([
            'active' => $activeUpdate,
        ]);

        $productstar   =  $this->productstar->find($id);
        if ($updateResult) {
            return response()->json([
                "code" => 200,
                "html" => view('admin.components.load-change-hot1', ['data' => $productstar, 'type' => 'sản phẩm'])->render(),
                "message" => "success"
            ], 200);
        } else {
            return response()->json([
                "code" => 500,
                "message" => "fail"
            ], 500);
        }
    }
}
