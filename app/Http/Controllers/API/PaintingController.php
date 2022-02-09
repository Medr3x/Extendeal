<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseAPIController;
use App\Models\Painting;
use Illuminate\Support\Facades\DB;

class PaintingController extends BaseAPIController
{
    public function index(Request $request)
    {
        $user_id = $request->headers->get('X-HTTP-USER-ID');
        if(empty($user_id)){
            return $this->APIResponse([], 500, "El valor X-HTTP-USER-ID en el Header es Obligatorio.");
        }

        if(isset($request->filters) && is_array($request->filters)){
            $filters = $request->filters;
        }else{
            $filters = [];
        }

        $fields = [];
        if(isset($request->fields)){
            $column_exist = [];
            $fields_explode = explode(',',$request->fields);
            foreach($fields_explode AS $value){
                $column_exist = \DB::select("SHOW COLUMNS FROM `paintings` LIKE '".$value."'");
                if(count($column_exist)>0){
                    $fields[] = $value;
                }
            }
        }else{
            $fields[] = '*';
        }
        
        $paintings = Painting::select($fields)->filters($filters)->paginate(10);
        return $this->APIResponse($paintings);
    }

    public function show(Painting $painting, Request $request)
    {
        $user_id = $request->headers->get('X-HTTP-USER-ID');
        if(empty($user_id)){
            return $this->APIResponse([], 500, "El valor X-HTTP-USER-ID en el Header es Obligatorio.");
        }
        return $this->APIResponse($painting);
    }

    //PaintingStoreRequest
    public function store(Request $request)
    {
        $user_id = $request->headers->get('X-HTTP-USER-ID');
        if(empty($user_id)){
            return $this->APIResponse([], 500, "El valor X-HTTP-USER-ID en el Header es Obligatorio.");
        }

        $request->request->add(['created_by' => $user_id]);
        $data = $request->only(
                            "name",
                            "code",
                            "painter",
                            "country",
                            "publication_date",
                            "status",
                            "relevance",
                            "created_by"
                        );

        $painting = Painting::create($data);

        return $this->APIResponse($painting, 200, 'Creado Correctamente.');
    }

    //PaintingUpdateRequest
    public function update(Request $request, Painting $painting)
    {
        $painting_id = $painting->id;
        $user_id = $request->headers->get('X-HTTP-USER-ID');
        if(empty($user_id)){
            return $this->APIResponse([], 500, "El valor X-HTTP-USER-ID en el Header es Obligatorio.");
        }

        $request->request->add(['updated_by' => $user_id]);
        $data = $request->only(
                            "name",
                            "code",
                            "painter",
                            "country",
                            "publication_date",
                            "status",
                            "relevance",
                            "updated_by"
                        );

        $painting = $painting->update($data);
        $painting = Painting::find($painting_id);

        return $this->APIResponse($painting, 200, 'Actualizado Correctamente.');
    }

    public function destroy(Request $request, Painting $painting)
    {
        $user_id = $request->headers->get('X-HTTP-USER-ID');
        if(empty($user_id)){
            return $this->APIResponse([], 500, "El valor X-HTTP-USER-ID en el Header es Obligatorio.");
        }

        $painting->update(['updated_by' => $user_id]);
        $painting->delete();

        return $this->APIResponse($painting, 200, 'Eliminado Correctamente.');
    }

    public function status(Request $request)
    {
        $data = ['REQUEST_TIME' => $request->server->get('REQUEST_TIME')];
        return $this->APIResponse($data, 200, 'Exito');
    }
}
