<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class ProductModel extends Model
{
    //
    protected $casts = [
        'date' => 'date:d-F-Y',
    ];
    
    protected $table ="product";
    protected $fillable =["name","detail","price","type","store_id"];
    public $pimarykey="id";
    
   public function lists($requert){
    $query = DB::table($this->table)
        ->select("{$this->table}.*","type.name as typename","store.name as storename")
        ->leftjoin('type',"{$this->table}.type","=","type.id")
        ->leftjoin('store',"{$this->table}.store_id","=","store.id")
        ;
    
    if(!empty($requert->search)){
        $query->where(function($q) use ($requert) {
            $q->where("{$this->table}.name",'LIKE',"%{$requert->search}%");
            $q->orWhere("{$this->table}.price",'LIKE',"%{$requert->search}%");
    
        });
    }
    if(!empty($requert->type)){
            $query->Where("{$this->table}.type",'LIKE',$requert->type);
        }
            
    if(!empty($requert->store)){
            $query->Where("{$this->table}.store_id",'LIKE',$requert->store);
        }
    return $query->paginate($requert->limit);

   
    }
    
}
