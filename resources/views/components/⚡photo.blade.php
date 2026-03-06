<?php

use Livewire\Component;
use App\Models\Animal;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;
    public $fotos=[];
    public $foto_path=[];
    public $fotos_animal=[];
    public $foto;
    public Animal|null $animal;

    public function updatedFoto(){
        $this->fotos[]= $this->foto;
        $this->foto_path[] = [
            'path' => $this->foto->getRealPath(),
            'name' => $this->foto->getClientOriginalName(),
            'mime' => $this->foto->getMimeType(),    
            ];
        $this->foto = null;
    }

    public function removeFoto($index)
    {
        unset($this->fotos[$index]);
        unset($this->foto_path[$index]);
    }

    public function removeFotoStorage($id){
        $foto = $this->animal->fotos()->find($id);

        if ($foto) {
        Storage::delete($foto->path);
        $foto->delete();
    }
    }

    public function mount($animal){
        $this->animal = $animal;
        if($this->animal){
            $this->fotos_animal = $this->animal->fotos; 
        }
    }
    
};
?>

<div>
    <label for="fotos" class="mb-2">{{__('animal.form.pictures')}}</label>
        <div class="images-container">
            <div class="upload-container"> 
            <input wire:model="foto" type="file" id="fileInput" class="upload-input"
                onchange="this.nextElementSibling.innerText = this.files[0]?.name || 'Clique ou arraste um ficheiro aqui'"
            >

            <label for="fileInput" class="upload-label">
                <x-heroicon-o-arrow-up-tray class="w-50 h-50 text-gray-500" />
            </label>
            
            </div> 
               @foreach($this->fotos_animal as $foto)
                    <div class="upload-container">
                        <button type="button" wire:click="removeFotoStorage({{ $foto->id }})" class="btn-close position-absolute top-0 end-0 m-2 bg-white rounded-square p-2" aria-label="Excluir">
                        </button>
                        <img src="{{Storage::url($foto->path)}}"
                        style="height: 190px; width: 135px; object-fit: cover; border-radius: 5px ;">
                    </div>
                @endforeach
               @foreach($this->fotos as $file)
                <div class="upload-container" wire:key="preview-{{ $loop->index }}">
                    <button type="button" wire:click="removeFoto({{ $loop->index }})" class="btn-close position-absolute top-0 end-0 m-2 bg-white rounded-square p-2" aria-label="Excluir">
                    </button>
                    <img src="{{$file->temporaryUrl()}}"
                        style="height: 190px; width: 135px; object-fit: cover; border-radius: 5px ;">
                </div>
            @endforeach      
                <input type="hidden" name="new_fotos" value="{{json_encode($this->foto_path)}}">

            </div>        
</div>