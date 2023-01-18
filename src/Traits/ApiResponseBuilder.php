<?php

namespace Marjose123\FilamentWebhookServer\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ApiResponseBuilder
{
    private array|null|object $payload;
    private ?string $message;
    private ?string $event;
    private ?string $module;

    public static function create(): ApiResponseBuilder
    {
        return (new static())
            ->setMessage(null);
    }

    public function setModelData(Model $model): static
    {

        $this->payload =  (object) $model->attributesToArray();
        return $this;
    }

    public function setModule($module) : static
    {
        $this->module = $module;
        return $this;
    }

    public function setEvent($event): static
    {
        $this->event = $event;
        return $this;
    }

    public function setMessage(?string $message): static
    {
        $this->message = $message;
        return $this;
    }

    public function setSummaryModelData(Model $model): static
    {
        $payload = [
            'id' => $model->id ?? $model->uuid ?? null,
            'created_at' => $model->created_at ?? Carbon::now()
        ];
        $this->payload = (object) $payload;
        return  $this;

    }

    public function generate()
    {
        $apiReponse =  [
            'event' => $this->event ?? null,
            'module' => $this->module,
            'triggered_at' => Carbon::now()->timezone('Asia/Manila'),
            'data' => $this->payload
        ];

        return (object) $apiReponse;
    }



}
