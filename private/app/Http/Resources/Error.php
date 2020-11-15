<?php

declare(strict_types=1);

namespace App\Http\Resources;

class Error implements \JsonSerializable
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
            'error' => [
                'message' => $this->message,
            ]
        ];
    }
}
