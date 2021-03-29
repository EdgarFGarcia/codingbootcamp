<?php

namespace App\Repository;

use App\Models\Category;
use App\Models\Item;
use DB;

class MainRepository{
    public static function insertcategory($data){
        return Category::create([
            'name'      => $data->name
        ]);
    }

    public static function getcategories($item = null){
        if($item > ''){
            return Category::where('name', 'like', "%{$item}%")->get();
        }
        return Category::get();
    }

    public static function editcategory($id, $data){
        return Category::where('id', $id)
        ->update([
            'name'  => $data['name']
        ]);
    }

    public static function deletecategory($id){
        return Category::where('id', $id)->delete();
    }

    public static function createitem($data){
        return Item::create([
            'name'          => $data['name'],
            'category_id'   => $data['category_id']
        ]);
    }

    public static function getitems($item = null){
        if($item > ''){
            return DB::table('items as a')
            ->select(
                'a.id as id',
                'a.name as name',
                'b.name as category',
                'b.id as category_id',
                'a.created_at as created_at',
                'a.updated_at as updated_at'
            )
            ->join('categories as b', 'a.category_id', '=', 'b.id')
            ->where('a.name', 'like', "%{$item}%")
            ->whereNull('a.deleted_at')
            ->get();
        }

        return DB::table('items as a')
        ->select(
            'a.id as id',
            'a.name as name',
            'b.name as category',
            'b.id as category_id',
            'a.created_at as created_at',
            'a.updated_at as updated_at'
        )
        ->join('categories as b', 'a.category_id', '=', 'b.id')
        ->whereNull('a.deleted_at')
        ->get();
    }

    public static function edititem($id, $data){
        return Item::where('id', $id)
        ->update([
            'name'          => $data['name'],
            'category_id'   => $data['category_id']
        ]);
    }

    public static function deleteitem($id){
        return Item::where('id', $id)->delete();
    }
}