<?php

namespace App\Http\Controllers;

use App\Models\Ai_analysis_log;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FileupController extends Controller
{
    //
    public function Fileup(Request $request)
    {
        $request_timestamp = 0;
        $response_timestamp = 0;


        $file_name = request()->file->getClientOriginalName();
        $image_path = request()->get('image_path');

        /*image_pathとLaravelの保存先指定ディレクトリが違うのでPathを成形*/
        //階層で配列化
        $img_dir_ary = explode('/', $image_path);
        //配列の最後の画像名を削除
        array_pop($img_dir_ary);
        //保存先がstrageなのでURl参照できるように / と　strage削除
        array_shift($img_dir_ary);
        array_shift($img_dir_ary);
        //再び階層を連結して保存先に使用
        $image_dir = implode('/', $img_dir_ary);
        Log::alert($image_path);
        Log::alert($image_dir);


        //画像をstrageに保存
        request()->file->storeAs('/public/'.$image_dir, $file_name);

        /** 以下はテスト用のレスポンスデータ */
        $json_success_array = array(
            "success" => true,
            "message" => "success",
            "estimated_data" => array(
                "class" => 3,
                "confidence" => 0.8683
            )
        );
        $json_success = json_encode($json_success_array);

        $json_failure_array = array(
            "success" => false,
            "message" => "Error:E50012",
            "estimated_data" => array()
        );

        $json_failure = json_encode($json_failure_array);

        /** テスト用のレスポンスデータ終わり */
        $request_timestamp = Carbon::now();
        try {
            //本来であればAPIからデータを受け取るが動作していないためfakeで成功した想定のレスポンスを返すよう設定
            Http::fake([
                'example.com/*' => Http::response($json_success)
            ]);
            $response = Http::post('http://example.com/', ['image_path' => $image_path]);
        } catch (\Throwable $th) {
            //throw $th;
            Log::alert($th->getMessage());
        }
        $response_timestamp = Carbon::now();

        Ai_analysis_log::create([
            "image_path" => $image_path,
            "success" => Arr::get($response, 'success'),
            "message" => Arr::get($response, 'message'),
            "class" => Arr::get($response, 'estimated_data.class', null),
            "confidence" => Arr::get($response, 'estimated_data.confidence', null),
            "request_timestamp" => $request_timestamp,
            "response_timestamp" => $response_timestamp
        ]);
    }

    public function Getfilelist(Request $request)
    {
        return Ai_analysis_log::get();
    }

    public function setuzoku()
    {
        return asset('app/public/imgs/1736753351187/20170518-shinyomawari-05.jpg');
    }
}
