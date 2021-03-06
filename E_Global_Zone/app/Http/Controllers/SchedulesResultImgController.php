<?php

namespace App\Http\Controllers;

use App\Schedule;
use App\SchedulesResultImg;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;

class SchedulesResultImgController extends Controller
{
    private $resultImage;

    public function __construct()
    {
        $this->resultImage = new SchedulesResultImg();
    }

    private function set_img(
        object $upload_img_file,
        string $img_file_name
    ): string {
        $extension = $upload_img_file->extension();                                        /* 확장자 얻기 */
        $storage_path = "{$img_file_name}.{$extension}";

        Storage::putFileAs('public', $upload_img_file, $storage_path);                     /* 파일 저장 후 경로 반환 */

        return $storage_path;
    }

    public function store_result_img(
        Schedule $schedule,
        object $start_img_file,
        object $end_img_file
    ): JsonResponse {
        // 파일 이름 규칙 정의.
        $sch_id = $schedule['sch_id'];
        $std_for_id = $schedule['sch_std_for'];
        $file_name_start = date("Ymd-{$std_for_id}-Hi_\S", strtotime($schedule['sch_start_date']));
        $file_name_end = date("Ymd-{$std_for_id}-Hi_\E", strtotime($schedule['sch_end_date']));

        // 로컬 스토리지에 이미지 파일 저장 -> 경로 반환
        $self_obj = new self();
        $start_img_url = $self_obj->set_img($start_img_file, $file_name_start);
        $end_img_url = $self_obj->set_img($end_img_file, $file_name_end);

        // DB 에 이미지 파일 경로 저장
        $store_data = [
            'sch_id' => $sch_id,
            'start_img_url' => $start_img_url,
            'end_img_url' => $end_img_url,
        ];

        return $this->resultImage->store_result_img_url($store_data);
    }

    /**
     * 이미지 파일 불러오기
     * @param Request $request
     */
    public function index_result_img(Request $request, SchedulesResultImg $sch_id): JsonResponse
    {
        // <<-- Request 요청 관리자 권한 검사.
        $is_admin = self::is_admin($request);

        if (is_object($is_admin)) {
            return $is_admin;
        }
        // -->>

        try {
            $img_data = (object) array(
                'start_img' => $this->resultImage->get_base64_img($sch_id['start_img_url']),
                'end_img' => $this->resultImage->get_base64_img($sch_id['end_img_url']),
            );
        } catch (Exception $e) {
            return self::response_json_error(Config::get('constants.kor.result_img.index.failure'));
        }

        return self::response_json(Config::get('constants.kor.result_img.index.success'), 200, $img_data);
    }
}
