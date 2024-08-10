<?php

namespace App\Http\DTO;

use App\Models\User;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class LogActivityDTO
{
    public function __construct(
        public int $user_id,
        public string $activity,
        public string $description
    )
    {
        $this->user_id = $this->getUser()?->id;
    }

    public static function fromRequest(array $data): self
    {
        $data['user_id'] = user()?->id;
        return new self(
            user_id: $data['user_id'],
            activity: $data['activity'],
            description: $data['description']
        );
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->user_id,
            'activity' => $this->activity,
            'description' => $this->description,
        ];
    }

    public function toEntity(): array
    {
        return [
            'user_id' => $this->user_id,
            'activity' => $this->activity,
            'description' => $this->description,
        ];
    }

    public function toResponse(): array
    {
        return [
            'user_id' => $this->user_id,
            'activity' => $this->activity,
            'description' => $this->description,
        ];
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */private function getUser(): User|null
    {
        return user() ?? null;
    }

    public function getUserName(): string
    {
        return $this->getUser()->name;
    }

    private function setDescription()
    {
        $this->description = $this->getUserName() . ' ' . $this->description;
    }

    public function setActivity(string $activity): void
    {
        $this->activity = $activity;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
