<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserVerificationResource\Pages;
use App\Filament\Resources\UserVerificationResource\RelationManagers;
use App\Models\UserVerification;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Support\Components\ViewComponent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth; // Import Auth
use Illuminate\Support\Facades\Storage; // Import Storage

class UserVerificationResource extends Resource
{
    protected static ?string $model = UserVerification::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Verifikasi dan Pembayaran';

    protected static ?string $navigationGroup = 'Data User';

    public static function getNavigationBadge(): ?string
    {
        if (Auth::user() && Auth::user()->hasRole('Super Admin')) {
            return static::getModel()::where('status', 'pending')->count();
        }
        return null;
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Select::make('user_id')
                    ->label('Pemilik Akun')
                    ->relationship('user', 'name')
                    ->required()
                    ->default(Auth::id())
                    ->disabled()
                    ->dehydrated(true),

                Forms\Components\TextInput::make('nama_lengkap')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('nama_ortu')
                    ->label('Nama Orang Tua')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('no_wa')
                    ->label('Nomor Whatsapp Orang Tua')
                    ->required()
                    ->maxLength(255),

                // Forms\Components\Actions::make([
                //     Forms\Components\Actions\Action::make('midtrans')
                //         ->label('Bayar via Midtrans')
                //         ->button()
                //         ->color('primary')
                //         ->icon('heroicon-o-credit-card')
                //         ->url(route('midtrans.payment'), shouldOpenInNewTab: true),
                // ]),
                Forms\Components\View::make('filament.components.midtrans-button')
                    ->label('Pembayaran via Midtrans'),

                Forms\Components\FileUpload::make('bukti_pembayaran')
                    ->label('Bukti Pembayaran')
                    ->required()
                    ->directory('verifikasi')
                    ->visibility('public'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                if (Auth::user() && !Auth::user()->hasRole('Super Admin')) {
                    $query->where('user_id', Auth::id());
                }
            })
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('User'),
                Tables\Columns\TextColumn::make('nama_lengkap')->label('Nama Lengkap'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status Verifikasi')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'diterima' => 'success',
                        'ditolak' => 'danger',
                        default => 'secondary',
                    }),
                Tables\Columns\TextColumn::make('keterangan')
                    ->label('Keterangan')
                    ->placeholder('-'),
                Tables\Columns\TextColumn::make('bukti_pembayaran')
                    ->label('Bukti Pembayaran')
                    ->formatStateUsing(fn($state) => 'Klik untuk melihat bukti pembayaran')
                    ->url(fn($record) => Storage::url($record->bukti_pembayaran))
                    ->openUrlInNewTab()
                    ->color('primary')
                    ->badge(),

            ])
            ->emptyStateHeading('Belum Ada Data Verifikasi dan Pembayaran')
            ->emptyStateDescription('Untuk dapat melanjutkan pendaftaran, silakan lengkapi data verifikasi dan unggah bukti pembayaran terlebih dahulu.')
            ->emptyStateIcon('heroicon-o-document-text')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->visible(function ($record) {
                        $user = Auth::user();
                        if ($user && $user->hasRole('Super Admin')) {
                            return true;
                        }
                        return $record->status === 'ditolak';
                    }),
                Tables\Actions\ViewAction::make()
                    ->label('Verifikasi'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUserVerifications::route('/'),
            'create' => Pages\CreateUserVerification::route('/create'),
            'view' => Pages\ViewUserVerification::route('/{record}'),
            'edit' => Pages\EditUserVerification::route('/{record}/edit'),
        ];
    }
}
