<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

class Register extends \Filament\Pages\Auth\Register
{
    public function form(Form $form): Form
    {
        return $form->schema([
            $this->getNameFormComponent(),
            TextInput::make('surname')
                ->label(__('users.surname'))
                ->required()
                ->maxLength(255),
            TextInput::make('patronymic')
                ->label(__('users.patronymic'))
                ->maxLength(255),
            DatePicker::make('date_of_birth')
                ->label(__('users.date_of_birth'))
                ->required(),
            Textarea::make('address')->maxLength(1000),
            $this->getEmailFormComponent(),
            $this->getPasswordFormComponent(),
            $this->getPasswordConfirmationFormComponent(),
        ]);
    }
}
