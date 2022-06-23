<?php

namespace App\Http\Controllers;
use App\Models\ViewPurchase;
use App\Models\AddPurchase;
use App\Models\region;
use App\Models\Sku;
use App\Models\Territory;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * @return Application|Factory|View
     * View zone page
     */
    public function zone()
    {
        $zoneDetails = Zone::all();
        $zoneCode = Zone::orderByDesc('zone_id')->first();
        return view('forms.addzone')->with(['zoneDetails' => $zoneDetails, 'zoneCode' => $zoneCode]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * add new zone
     */
    public function addZone(Request $request): RedirectResponse
    {

        $request->validate([
            'zone_id' => 'required',
            'long_description' => 'required',
            'short_description' => 'required'
        ]);

        try {
            Zone::create($request->all());
        }catch (\Throwable $e){
            return back()->with(['error' => 'Zone added failed', 'error_type' => 'error']);
        }

        return back()->with(['success' => 'Zone added successful']);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * update zone
     */
    public function zoneUpdate(Request $request): RedirectResponse{
        $request->validate([
            'zone_id' => 'required',
            'long_description' => 'required',
            'short_description' => 'required'
        ]);

        try {
            Zone::find(\request('zone_id'))->update($request->all());
        }catch (\Throwable $e){
            return back()->with(['error' => 'Zone added failed', 'error_type' => 'error']);
        }

        return back()->with(['success' => 'Zone added successful']);
    }

    /**
     * @return Application|Factory|View
     * region page
     */
    public function region()
    {
        $zoneDetails = Zone::all();
        $regionDetails = Region::all();
        $regionCode = Region::orderByDesc('region_id')->first();
        return view('forms.addregion')->with(['regionCode' => $regionCode, 'regionDetails' => $regionDetails, 'zoneDetails' => $zoneDetails]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * add new region
     */
    public function addRegion(Request $request): RedirectResponse
    {
        $request->validate([
            'zone_id' => 'required',
            'region_id' => 'required',
            'name' => 'required'
        ]);

        try {
            Region::create($request->all());
        }catch (\Throwable $e){
            return back()->with(['error' => 'Region added failed', 'error_type' => 'error']);
        }

        return back()->with(['success' => 'Region added successful']);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * update region
     */
    public function regionUpdate(Request $request): RedirectResponse{
        $request->validate([
            'zone_id' => 'required',
            'region_id' => 'required',
            'name' => 'required'
        ]);

        try {
            Region::find(\request('region_id'))->update($request->all());
        }catch (\Throwable $e){
            return back()->with(['error' => 'Zone added failed', 'error_type' => 'error']);
        }

        return back()->with(['success' => 'Zone added successful']);
    }

    /**
     * @return Application|Factory|View
     * view sku page
     */
    public function sku(){
        $skuDetails = Sku::all();
        $sku_id = Sku::orderbyDesc('sku_id')->first();
        return view('forms.addsku')->with(['skuDetails' => $skuDetails, 'sku_id' => $sku_id]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * add Products
     */
    public function addSku(Request $request): RedirectResponse
    {
        $request->validate([
            'sku_id' => 'required',
            'sku_code' => 'required',
            'sku_name' => 'required',
            'mrp' => 'required|integer',
            'distributor_price' => 'required|numeric',
            'weight_volume' => 'required|numeric',
            'weight_unit' => 'required'
        ]);

        try {
            Sku::create($request->all());
        }catch (\Throwable $e){
            dd($e);
            return back()->with(['error' => 'Sku added failed', 'error_type' => 'error']);
        }

        return back()->with(['success' => 'Sku added successful']);
    }

    /**
     * @return Application|Factory|View
     * view territory
     */
    public function territory()
    {
        $territoryDetails = Territory::all();
        $zoneDetails = Zone::all();
        $regionDetails = Region::all();
        $territory_id = Territory::orderByDesc('territory_id')->first();
        return view('forms.addterritory')->with(['territory_id' => $territory_id, 'territoryDetails' => $territoryDetails, 'zoneDetails' => $zoneDetails, 'regionDetails' => $regionDetails]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * add territory
     */
    public function addTerritory(Request $request): RedirectResponse
    {
        $request->validate([
            'zone_id' => 'required',
            'region_id' => 'required',
            'territory_id' => 'required',
            'territory_name' => 'required',
        ]);

        try {
            Territory::create($request->all());
        }catch (\Throwable $e){
            return back()->with(['error' => 'Territory added failed', 'error_type' => 'error']);
        }

        return back()->with(['success' => 'Territory added successful']);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     *update territory
     */
    public function territoryUpdate(Request $request): RedirectResponse{
        $request->validate([
            'zone_id' => 'required',
            'region_id' => 'required',
            'territory_id' => 'required',
            'territory_name' => 'required',
        ]);

        try {
            territory::find(\request('territory_id'))->update($request->all());
        }catch (\Throwable $e){
            return back()->with(['error' => 'Territory added failed', 'error_type' => 'error']);
        }

        return back()->with(['success' => 'Territory added successful']);
    }

    /**
     * @return Application|Factory|View
     * view user
     */
    public function user(){
        $territoryDetails= Territory::all();
        return view('forms.adduser')->with(['territoryDetails' => $territoryDetails]);
    }

    public function addPurchase(Request $request): RedirectResponse
    {

        $request->validate([
            'zone' => 'required',
            'region' => 'required',
            'territory' => 'required',
            'distributor' => 'required',
            'date' => 'required',
            'po_no' => 'required',
            'remark' => 'required'
        ]);

        try {
            AddPurchase::create($request->all());
        }catch (\Throwable $e){
            return back()->with(['error' => 'Purchase added failed', 'error_type' => 'error']);
        }

        return back()->with(['success' => 'Purchase added successful']);
    }
    public function viewProduct()
    {
        $productDetails=ViewPurchase::all();
        $zoneDetails = Zone::all();
        $regionDetails=Region::all();
        $territoryDetails=Territory::all();
        $zoneCode = Zone::orderByDesc('zone_id')->first();
        return view('forms.viewpurchase')->with(['zoneDetails' => $zoneDetails, 'zoneCode' => $zoneCode, 'regionDetails' => $regionDetails,'territoryDetails' => $territoryDetails, 'productDetails'=>$productDetails]);
    }
    public function product()
    {
        return view('forms.viewpurchase');
    }

    public function getZoneByRegion(Request $request): \Illuminate\Http\JsonResponse
    {
        $regID = \request('regId');
        $zoneId = Region::find($regID)->zone->zone_id;

        return response()->json($zoneId);
    }
}
