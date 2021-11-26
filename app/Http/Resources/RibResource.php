<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RibResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /*
            Add the additional fields(Recette, Depense) to the operation
        */
        return [
            'id' => $this->id,
            'label' => $this->label,
            'date' => $this->date,
            'amount' => $this->amount,
            'recette' => $this->recette($this->amount),
            'depense' => $this->depense($this->amount)            
        ];
    }

    # add field Récette
    private function recette($amount) {
        return ($amount > 0) ? $amount : 0;
    }

    # add field Depense
    private function depense($amount) {
        return ($amount < 0) ? abs($amount) : 0;
    }
}
