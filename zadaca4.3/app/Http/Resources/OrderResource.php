<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'order_date' => $this->order_date,
            'client_name'=> $this->client_name,
            'client_contact'=> $this->client_contact,
            'product_name'=> $this->product_name,
            'noOfProducts'=> $this->noOfProducts,
            'sub_total'=> $this->sub_total,
            'vat'=> $this->vat,
            'discount'=> $this->discount,
            'total_amount'=> $this->total_amount,
            'paid'=> $this->paid,
            'due'=> $this->due,
            'payment_type'=> $this->payment_type,
            'payment_status'=> $this->payment_status,
            'product_id'=> $this->product_id,
            'user_id'=> $this->user_id,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
