<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Berita; // Import Berita model
use App\Models\Pendaftaran; // Import Pendaftaran model
use App\Models\User; // Import User model

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 0; // Display this widget at the top

    protected function getStats(): array
    {
        // Get counts from your models
        $beritaCount = Berita::count();
        $pendaftaranCount = Pendaftaran::count();
        $userCount = User::count();

        return [
            // Define a Stat for Berita count
            Stat::make('Jumlah Berita', $beritaCount)
                ->description('Total berita yang dipublikasikan')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('success'),

            // Define a Stat for Pendaftaran count
            Stat::make('Jumlah Pendaftar', $pendaftaranCount)
                ->description('Total formulir pendaftaran')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('info'),

            // Define a Stat for User count
            Stat::make('Jumlah User', $userCount)
                ->description('Total pengguna terdaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('warning'),
        ];
    }
}
