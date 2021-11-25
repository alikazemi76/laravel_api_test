<?php
namespace  App\Traits;



use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

trait ApiResponse
{
    public function responseSuccess($data, $messages = [], $code = 200 ,$meta=null)
    {
        if( $data instanceof AnonymousResourceCollection ){
            if(isset($data->response()->getDate()->meta)){
                $meta=$data->response()->getDate()->meta;
            }
        }
        return response()->json([
            'data' => $data,
            'success' => true,
            'messages' => $messages,
            'meta'=>$meta
        ], $code);
    }


    public function responseError($messages = [], $code = 500, $data = null)
    {
        return response()->json([
            'data' => $data,
            'success' => false,
            'messages' => $messages
        ], $code);
    }
}
