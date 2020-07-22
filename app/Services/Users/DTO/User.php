<?php

namespace App\Services\Users\DTO;

class User
{

    public $name = null;
    public $email = null;
    public $password = null;
    public $balance = null;
    public $group_id = null;

    public static function fromArray(array $data)
    {
        $self = new self();

        $self->name = $data['name'] ?? '';
        $self->email = $data['email'] ?? '';
        $self->password = $data['password'] ?? null;
        $self->balance = $data['balance'] ?? null;
        $self->group_id = $data['group_id'] ?? null;

        return $self;
    }

    public function toArray(): array
    {
        $data = [
            'name' => $this->name,
            'email' => $this->email,
        ];

        if ($this->password) {
            $data['password'] = $this->password;
        }

        if (isset($this->balance)) {
            $data['balance'] = $this->balance;
        }

        if (isset($this->group_id)) {
            $data['group_id'] = $this->group_id;
        }

        return $data;
    }
}
