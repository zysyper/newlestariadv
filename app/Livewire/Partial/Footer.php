<?php

namespace App\Livewire\Partial;

use App\Models\kategori;
use Livewire\Component;

class Footer extends Component
{

    public function render()
    {
        $kategoris = kategori::where('is_active', 1 )->get();
        return view('livewire.partial.footer', [
            'kategoris' => $kategoris,
        ]);
    }
}
