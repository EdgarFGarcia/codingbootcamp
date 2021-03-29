<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MainRepository, Validator;

class ApiController extends Controller
{
    //
    /**
     * Start API Category
     */
    public function createcategory(Request $request){
        $validation = Validator::make($request->all(),[
            'name'      => 'required|string'
        ]);

        if($validation->fails()){
            $error = $validation->messages()->first();
            return response()->json([
                'response'      => false,
                'message'       => $error
            ], 422);
        }

        return response()->json([
            'response'      => true,
            'data'          => MainRepository::insertcategory($request)
        ], 200);
    }

    public function getcategory($item = null){
        if($item > ''){
            return MainRepository::getcategories($item);
        }
        return MainRepository::getcategories();
    }

    /**
     * params id, payload return edited record
     */
    public function updatecategory($id = null, Request $request){
        if($id > ''){

            $validation = Validator::make($request->all(), [
                'name'      => 'required|string'
            ]);

            if($validation->fails()){
                return response()->json([
                    'response'      => false,
                    'message'       => $validation->messages()->first()
                ], 422);
            }

            return response()->json([
                'response'      => true,
                'data'          => MainRepository::editcategory($id, $request->all())
            ], 200);
        }
        return response()->json([
            'response'      => false,
            'message'       => "Empty ID"
        ], 422);
    }


    /**
     * params id
     * return status code either 1 or 0
     */
    public function deletecategory($id = null){
        try{
            if($id > ''){
                return response()->json([
                    'response'      => true,
                    'data'          => MainRepository::deletecategory($id)
                ], 200);
            }
        }catch(\Exception $e){
            return response()->json([
                'response'      => false,
                'message'       => $e
            ], 422);
        }
    }
    /**
     * End API Category
     */

    /**
     * Item API Start
     */
    public function createitme(Request $request){

        $validation = Validator::make($request->all(), [
            'name'          => 'required|string',
            'category_id'   => 'required|numeric'
        ]);

        if($validation->fails()){
            return response()->json([
                'response'      => false,
                'message'       => $validation->messages()->first()
            ], 422);
        }

        return response()->json([
            'response'      => true,
            'data'          => MainRepository::createitem($request->all())
        ], 200);

    }

    public function getitems($item = null){
        if($item > ''){
            return response()->json([
                'response'      => true,
                'data'          => MainRepository::getitems($item)
            ], 200);
        }
        return response()->json([
            'response'      => true,
            'data'          => MainRepository::getitems()
        ], 200);
    }

    /**
     * params id,
     * Request as:
     *  name,
     *  category_id
     */
    public function updateitem($id = null, Request $request){
        $validation = Validator::make($request->all(),[
            'name'          => 'required|string',
            'category_id'   => 'required|numeric'
        ]);
        if($validation->fails()){
            return response()->json([
                'response'      => false,
                'message'       => $validation->messages()->first()
            ], 422);
        }
        
        return response()->json([
            'response'      => true,
            'data'          => MainRepository::edititem($id, $request->all())
        ], 200);
        
    }

    public function deleteitem($id = null){
        if($id > ''){
            return response()->json([
                'response'      => true,
                'data'          => MainRepository::deleteitem($id)
            ], 200);
        }

        return response()->json([
            'response'          => false,
            'data'              => ''
        ], 422);
    }
     /**
      * Item API End
      */
}
