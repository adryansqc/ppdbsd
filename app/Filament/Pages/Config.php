<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms\Form;
use Filament\Forms\Components;
use App\Models\Config as ConfigModel;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Config extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static ?string $navigationLabel = 'Setting App';

    protected static ?string $navigationGroup = 'Pengaturan';

    protected static string $view = 'filament.pages.config';

    public ?array $data = [];

    public static function canAccess(): bool
    {
        return Auth::user()->hasRole('Super Admin');
    }

    public function mount(): void
    {
        $configs = ConfigModel::all()->keyBy('key');
        $formData = [];
        foreach ($configs as $key => $config) {
            $formData[$key] = $config->value;
        }
        $this->form->fill($formData);
    }

    public function form(Form $form): Form
    {
        $configs = ConfigModel::all();
        $schema = [];

        foreach ($configs as $config) {
            $field = null;
            switch ($config->type) {
                case 'text':
                    $field = Components\TextInput::make($config->key)
                        ->label($config->name);
                    break;
                case 'number':
                    $field = Components\TextInput::make($config->key)
                        ->label($config->name)
                        ->numeric();
                    break;
                case 'file':
                    $field = Components\FileUpload::make($config->key)
                        ->label($config->name)
                        ->directory('config')
                        ->visibility('public');
                    break;
                default:
                    $field = Components\TextInput::make($config->key)
                        ->label($config->name);
                    break;
            }
            if ($field) {
                $schema[] = $field;
            }
        }

        return $form
            ->schema($schema)
            ->statePath('data');
    }

    public function submit(): void
    {
        try {
            $data = $this->form->getState();

            foreach ($data as $key => $value) {
                $config = ConfigModel::where('key', $key)->first();
                if ($config) {
                    if ($config->type === 'file' && is_array($value) && isset($value[0])) {
                        $config->value = $value[0];
                    } elseif ($config->type === 'file' && is_string($value)) {
                        $config->value = $value;
                    } else {
                        $config->value = $value;
                    }
                    $config->save();
                }
            }

            Notification::make()
                ->title('Pengaturan berhasil disimpan')
                ->success()
                ->send();
        } catch (\Exception $e) {
            Notification::make()
                ->title('Gagal menyimpan pengaturan')
                ->danger()
                ->body($e->getMessage())
                ->send();
        }
    }
}
