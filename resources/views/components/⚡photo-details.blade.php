<?php

use Livewire\Component;
use App\Models\Animal;

new class extends Component
{
    public Animal $animal;
    public $photo_path=[];
    public $var = 0;
    public $current_photo = null;

    public function mount($animal){
        $this->animal = $animal;
        $this->photo_path = $this->animal->fotos->pluck('path');
        if(!empty($this->photo_path)){
            $this->current_photo = $this->photo_path[$this->var];
        }
    }

      public function left()
    {
        if ($this->var > 0) {
            $this->var--;
            $this->current_photo = $this->photo_path[$this->var];
        }
    }

    public function right()
    {
        if ($this->var < count($this->photo_path) - 1) {
            $this->var++;
            $this->current_photo = $this->photo_path[$this->var];
        }
    }
};
?>

        <div class="col-lg-6 position-relative" style="min-height: 500px; background-color: #f8f9fa;">
                @if($animal->fotos->isNotEmpty())
                    <img src="{{Storage::url($this->current_photo)}}"
                        class="img-fluid w-100 h-100 object-fit-cover position-absolute top-0 start-0"
                        alt="{{ $animal->nome }}">
                @else
                    <div class="d-flex align-items-center justify-content-center h-100 text-muted">
                        <i class="fas fa-paw fa-3x"></i>
                    </div>
                @endif

                <button wire:click="left()"  {{$this->var === 0 ? 'hidden' : ''}}
                class="btn btn-light bg-white bg-opacity-75 shadow rounded-circle
                       position-absolute top-50 start-0 translate-middle-y ms-3"
                        style="width: 50px; height: 50px;">
                    <i class="fas fa-arrow-left"></i>
                </button>

                <button wire:click="right()" {{$this->var === count($this->photo_path) - 1 ? 'hidden' : ''}}
                class="btn btn-light bg-white bg-opacity-75 shadow rounded-circle
                       position-absolute top-50 end-0 translate-middle-y me-3"
                        style="width: 50px; height: 50px;">
                <i class="fas fa-arrow-right"></i>
                </button>
        </div>