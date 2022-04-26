<?php

namespace App\Http\Controllers;

use App\Models\Awards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validation;
use App\Http\Requests\AwardsRequest;
use Helper;



class AwardsController extends Controller
{
    function __construct()
    {


    }

    function index(AwardsRequest $request) : object
    {
        $id = auth('sanctum')->user()->id;
        $start = $request->get('start');
        $limit = $request->get('limit');
        $type = $request->get('type');
        $startPoint = $request->get('start_point');
        $endPoint = $request->get('end_point');
        $query = DB::table('mapping_awards');
        $query = $query->join('users', 'mapping_awards.users_id', '=', 'users.id');
        $query = $query->join('awards', 'mapping_awards.awards_id', '=', 'awards.id');
        if($type!='all'){
            $query = $query->where('awards.type',$type);
        }
        if($startPoint && $endPoint){
            $query = $query->whereBetween('mapping_awards.poin', [$startPoint, $endPoint]);
        }
        $query = $query->where('users.id',$id);
        $query = $query->skip($start)->take($limit)->get(
            ['mapping_awards.id','users_id','awards_id','note','poin','type']
        );
        $response = Helper::responseApp(data: $query);
        return response()->json($response);
    }

}
