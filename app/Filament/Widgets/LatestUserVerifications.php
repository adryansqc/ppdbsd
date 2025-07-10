<?php

namespace App\Filament\Widgets;

use App\Models\UserVerification; // Import model UserVerification
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth; // Import Auth
use Filament\Widgets\Widget; // Import Widget base class

// Change the base class from BaseWidget (TableWidget) to Widget
class LatestUserVerifications extends Widget
{
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    protected static string $view = 'filament.widgets.latest-user-verifications';

    protected function getViewData(): array
    {
        $user = Auth::user();
        $verification = null;
        if ($user && !$user->hasRole('Super Admin')) {
            $verification = UserVerification::where('user_id', $user->id)->first();
        }

        return [
            'user' => $user,
            'verification' => $verification,
        ];
    }
}
