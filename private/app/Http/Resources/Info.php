<?php

declare(strict_types=1);

namespace App\Http\Resources;

class Info implements \JsonSerializable
{
    protected string $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'message' => $this->message,
        ];
    }
}
