<?php

namespace App\Listeners;

use App\Enum\StatusCode;
use Dingo\Api\Event\ResponseWasMorphed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class FormatResponse
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param ResponseWasMorphed $event
     */
    public function handle(ResponseWasMorphed $event)
    {
        // 统一响应格式
        if (is_null($event->content)) {
            $event->content = [];
        }
        [$messageKey, $errorsKey, $codeKey, $statusCodeKey, $debugKey] = array_keys(config('api.errorFormat'));
        $metaStatus = $event->response->getStatusCode();

        $requestData = null;
        // 成功响应才返回data数据
        if (preg_match("/^2[0-9]{2}$/", $metaStatus)) {
            $requestData = isset($event->content['data']) ? $event->content['data'] : $event->content;
        } else {
            // 区分Http code和业务code
            $event->response->setStatusCode(StatusCode::CODE_200);
        }
        $metaMsg = isset($event->content[$messageKey]) ? $event->content[$messageKey] : '';

        $requestContent = [
            'data' => $requestData,
            'meta' => [
                'msg'    => $metaMsg,
                'status' => $metaStatus,
            ],
        ];
        if (isset($event->content[$debugKey])) {
            $requestContent['meta'][$debugKey] = $event->content[$debugKey];
        }
        if (isset($event->content[$errorsKey])) {
            $errorsArray = collect($event->content[$errorsKey])->flatten()->toArray();
            $requestContent['meta']['msg'] = implode(' ', $errorsArray);
        }

        // 分页处理
        if (isset($event->content) && isset($event->content['meta']) && isset($event->content['meta']['pagination'])) {
            $requestContent['data'] = null;
            $requestContent['data']['list'] = $requestData;
            $requestContent['data']['page'] = $event->content['meta']['pagination']['current_page'];
            $requestContent['data']['pageSize'] = $event->content['meta']['pagination']['per_page'];
            $requestContent['data']['total'] = $event->content['meta']['pagination']['total'];
        }

        $event->content = $requestContent;
    }
}
