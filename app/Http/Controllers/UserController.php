<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderSku;
use App\Models\Region;
use App\Models\Sku;
use App\Models\Territory;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * @return Application|Factory|View
     */
    public function viewPurchaseOrder()
    {
        $territoryDetails = Territory::all();
        $zoneDetails = Zone::all();
        $regionDetails = Region::all();
        $distributorDetails = User::where('role', 'user')->orderBy('user_name', 'asc')->get();
        $lastPOInfo = PurchaseOrder::orderByDesc('purchase_order_id')->first();

        $skuDetails = Sku::orderBy('sku_name', 'asc')->get();
        return view('tables.addpurchase')->with(['skuDetails' => $skuDetails, 'lastPOInfo' => $lastPOInfo, 'territoryDetails' => $territoryDetails, 'zoneDetails' => $zoneDetails, 'regionDetails' => $regionDetails, 'distributorDetails' => $distributorDetails]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getSkuDetails(Request $request): JsonResponse
    {
        $sku_id = \request('SKU_ID');
        $skuDetails = Sku::find($sku_id);

        return response()->json($skuDetails);
    }


    public function addPurchaseOrder(Request $request)
    {
        $request->validate([
            'zone_id' => 'required',
            'region_id' => 'required',
            'territory_id' => 'required',
            'distributor_id' => 'required',
            'purchase_date' => 'required',
            'purchase_no' => 'required',
            'remark' => 'nullable'
        ]);

        try {
            DB::transaction(function () use($request){
                $addPurchaseOrder = PurchaseOrder::create($request->all());

                foreach (\request('sku_id') as $key => $skuID){
                    $price = $request->tot_amount[$key];
                    $quantity = $request->qty[$key];

                    PurchaseOrderSku::create([
                        'sku_id' => $skuID,
                        'quantity' => $quantity,
                        'price' => $price,
                        'purchase_order_id' => $addPurchaseOrder->purchase_order_id,
                    ]);
                }

            });
        } catch (\Throwable $e) {
//            dd($e);
            return back()->with(['error' => $e->getMessage(), 'error_type' => 'error']);
        }

        return back()->with(['success'=> 'Purchase order added.']);

    }
}
