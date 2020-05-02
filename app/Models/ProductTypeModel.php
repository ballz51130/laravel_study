<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class ProductTypeModel extends Model
{
    //
    protected $table ="type";
    protected $fillable =["name"];
    public $pimarykey="id";
   public function lists($requert){
    $query = DB::table($this->table);
    if(!empty($requert->search)){
        $query->where('name','LIKE',"%{$requert->search}%");
    }
    return $query->paginate($requert->limit);
    }
}
