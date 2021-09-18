<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Order;
use Livewire\WithPagination;

class Myorders extends Component
{
    use WithPagination;

    public function render()
    {

        return view('livewire.hola', [
            'myorders' => Order::where('status', '<>', 1)->orderBy('id', 'asc')->paginate(10),
        ]);
    }
}
