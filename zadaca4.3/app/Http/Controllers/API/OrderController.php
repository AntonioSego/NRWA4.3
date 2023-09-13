<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Order;

use Illuminate\Support\Facades\Validator;
use App\Http\Resources\OrderResource;
use Illuminate\Http\JsonResponse;

class OrderController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        $orders = Order::all();
        
        return $this->sendResponse(OrderResource::collection($orders), 'Orders retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();
       
        $validator = Validator::make($input, [
            'order_date'  => 'required | date' ,
            'client_name' => 'required',
            'client_contact' => 'required',
            'product_name'=> 'required',
            'noOfProducts' => 'required | numeric',
            'sub_total' => 'required',
            'vat' => 'required',
            'discount'=> 'required',
            'total_amount' => 'required ',
            'paid' => 'required',
            'due' => 'required',
            'payment_type'=> 'required',
            'payment_status' => 'required',
            'product_id' => 'required | numeric',
            'user_id' => 'required | numeric'
        ]);
       
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
       
        $order = Order::create($input);
       
        return $this->sendResponse(new OrderResource($order), 'Order created successfully.');
    } 

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): JsonResponse
    {
        $order = Order::find($id);
      
        if (is_null($order)) {
            return $this->sendError('Order not found.');
        }
       
        return $this->sendResponse(new OrderResource($order), 'Order retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order): JsonResponse
    {
        $input = $request->all();
       
        $validator = Validator::make($input, [
            'order_date'  => 'required | date' ,
            'client_name' => 'required',
            'client_contact' => 'required',
            'product_name'=> 'required',
            'noOfProducts' => 'required | numeric',
            'sub_total' => 'required',
            'vat' => 'required',
            'discount'=> 'required',
            'total_amount' => 'required ',
            'paid' => 'required',
            'due' => 'required',
            'payment_type'=> 'required',
            'payment_status' => 'required',
            'product_id' => 'required | numeric',
            'user_id' => 'required | numeric'
        ]);
       
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
       
        $order->order_date = $input['order_date'];
        $order->client_name = $input['client_name'];
        $order->client_contact = $input['client_contact'];
        $order->product_name = $input['product_name'];
        $order->noOfProducts = $input['noOfProducts'];
        $order->sub_total = $input['sub_total'];
        $order->vat = $input['vat'];
        $order->discount = $input['discount'];
        $order->total_amount = $input['total_amount'];
        $order->paid = $input['paid'];
        $order->due = $input['due'];
        $order->payment_type = $input['payment_type'];
        $order->payment_status = $input['payment_status'];
        $order->product_id = $input['product_id'];
        $order->user_id = $input['user_id'];

        $order->save();
       
        return $this->sendResponse(new OrderResource($order), 'Order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order): JsonResponse
    {
        $order->delete();
       
        return $this->sendResponse([], 'Order deleted successfully.');
    }
}
