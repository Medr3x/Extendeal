<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Painting extends Model
{ 
    use SoftDeletes, HasFactory;
    
    protected $table = 'paintings';
    public $timestamps = true;
    protected $fillable = [
        'name',
        'code',
        'painter',
        'country',
        'publication_date',
        'status',
        'relevance',
        'created_by',
        'updated_by'
    ];

    public function scopeFilters($query, $filters = [])
    {
        $column_exist = null;
        foreach($filters AS $key => $value){
            $column_exist = \DB::select("SHOW COLUMNS FROM `".$this->table."` LIKE '".$key."'");
            if(count($column_exist)>0){
                $query = $query->where($key,'=',$value);
            }
        }
        return $query;
    }
}
