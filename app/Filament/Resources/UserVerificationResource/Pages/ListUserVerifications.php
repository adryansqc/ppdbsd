<?php

namespace App\Filament\Resources\UserVerificationResource\Pages;

use App\Filament\Resources\UserVerificationResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Auth;
use Filament\Actions\StaticAction;

class ListUserVerifications extends ListRecords
{
    protected static string $resource = UserVerificationResource::class;

    protected function getHeaderActions(): array
    {
        $user = Auth::user();
        $verification = $user->userVerification;

        if (!$verification) {
            return [
                Actions\CreateAction::make()
                    ->label('Lakukan Pembayaran'),
            ];
        }

        if ($verification->status === 'pending') {
            return [
                Action::make('pending')
                    ->label('silahkan menunggu verifikasi untuk bisa mengakases pendaftaran')
                    ->disabled()
                    ->color('danger'),
            ];
        }
        if ($verification->status === 'diterima') {
            return [
                Action::make('diterima')
                    ->label('Akun anda telah di verifikasi silahkan lakukan pendaftaran')
                    ->disabled()
                    ->color('gray'),
            ];
        }

        return [];
    }

    public function getTitle(): string|Htmlable
    {
        return 'Verifikasi dan Pembayaran';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
