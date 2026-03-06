<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

use function Symfony\Component\Clock\now;

class Fotos extends Model
{
    protected $fillable = [
        'id',
        'path', 
        'foto_model_type', 
        'foto_model_id'
        ];

    public function foto_model()
    {
        return $this->morphTo();
    }

    public static function storeFoto(array|UploadedFile $data){
        if(is_array($data)){
             $uploaded = new UploadedFile($data['path'], now()->getTimestamp(), $data['mime'], null, true);
        } else {
            $uploaded = $data;
        }
        $path = $uploaded->store('images','public');
        return $path;
    }

      public static function createNew(array $data = []){

       return Fotos::create([
        'path'=> $data['path'],
        'foto_model_type'=> $data['model_class'],
        'foto_model_id'=> $data['model_id'],
        ]);

    }
}
