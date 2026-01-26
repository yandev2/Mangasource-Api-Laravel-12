<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArrayResource extends JsonResource
{
    public $status;
    public $message;
    public $resource;

    public function __construct($status, $message, $resource)
    {
        parent::__construct($resource);
        $this->status  = $status;
        $this->message = $message;
    }
    public function toArray(Request $request): array
    {
        return [
            'success'   => $this->status,
            'message'   => $this->message,
            'data'      => $this->resource,
            'info' => [
                'developer' => 'https://github.com/yandev2',
                'note' => "Disclaimer This app only displays information from public sources. All manga content belongs to its respective copyright holders. We do not store any files on our servers. To read the full story and support the creators, please visit the source's official website.",
            ]
        ];
    }
}
