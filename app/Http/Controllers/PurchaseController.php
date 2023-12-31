<?php

namespace App\Http\Controllers;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchases = Purchase::all();
        $array = [];

        foreach($purchases as $purchase){
            $array[]= [
                'id' => $purchase->id,
                'product_quantity' => $purchase->product_quantity,
                'amount' => $purchase->amount,
                'purchase_state' => $purchase->purchase_state,
                'created_at' => $purchase->created_at,
                'updated_at' => $purchase->updated_at,
                'products' => $purchase->products,
                'payment' => $purchase->payment

            ];
        }
        return response()->json($array);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {      
            $purchases = new Purchase;
            $purchases->product_quantity = $request->product_quantity;
            $purchases->amount = $request->amount;
            $purchases->purchase_state = $request->purchase_state;
            $purchases->save();
            //return $purchase as json response
            $data = array(
                'message' => 'Purchase created successfully',
                'purchase' => $purchases
            );
            return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        //return $purchase as json response
        return response()->json($purchase);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
            $purchase->product_quantity = $request->product_quantity;
            $purchase->amount = $request->amount;
            $purchase->purchase_state = $request->purchase_state;
            $purchase->save();
            //return $purchase as json response
            $data = array(
                'message' => 'Purchase created successfully',
                'purchase' => $purchase
            );
            return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
        //return $purchase as json response
        $data = array(
            'message' => 'Purchase deleted successfully',
            'purchase' => $purchase
        );
        return response()->json($data);
    }
    
    public function attach(Request $request){
        $purchase = Purchase::find($request->purchase_id);
        $purchase->products()->attach($request->product_id);
        //return $purchase as json response
        $data = array(
            'message' => 'Purchase attached successfully',
            'purchase' => $purchase
        );
        return response()->json($data);
    }

    public function attachPayment(Request $request){
        $purchase = Purchase::find($request->purchase_id);
        $purchase->payment()->attach($request->payment_id);
        //return $purchase as json response
        $data = array(
            'message' => 'Payment attached successfully',
            'purchase' => $purchase
        );
        return response()->json($data);
    }

    public function detach(Request $request){
        $purchase = Purchase::find($request->purchase_id);
        $purchase->products()->detach($request->product_id);
        //return $purchase as json response
        $data = array(
            'message' => 'Product detached successfully',
            'purchase' => $purchase
        );
        return response()->json($data);
    }

    public function detachPayment(Request $request){
        $purchase = Purchase::find($request->purchase_id);
        $purchase->payment()->detach($request->payment_id);
        //return $purchase as json response
        $data = array(
            'message' => 'Payment detached successfully',
            'purchase' => $purchase
        );
        return response()->json($data);
    }
}
