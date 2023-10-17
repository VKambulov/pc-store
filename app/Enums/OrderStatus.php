<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum OrderStatus: string implements HasLabel
{
    case Draft = 'draft';
    case Pending = 'pending';
    case InTransit = 'in_transit';
    case Done = 'done';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Draft => 'Черновик',
            self::Pending => 'В обработке',
            self::InTransit => 'В пути',
            self::Done => 'Завершен',
        };
    }
}
