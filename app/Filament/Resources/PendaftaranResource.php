<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PendaftaranResource\Pages;
use App\Filament\Resources\PendaftaranResource\RelationManagers;
use App\Models\Pendaftaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class PendaftaranResource extends Resource
{
    protected static ?string $model = Pendaftaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('Informasi Akun')
                    ->schema([

                        Forms\Components\Select::make('user_id')
                            ->label('Pemilik Akun')
                            ->relationship('user', 'name')
                            ->required()
                            ->default(Auth::id())
                            ->disabled()
                            ->dehydrated(true),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('Data Pribadi Siswa')
                    ->schema([
                        Forms\Components\TextInput::make('nama_lengkap')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('tempat_lahir')
                            ->label('Tempat Lahir')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('tanggal_lahir')
                            ->label('Tanggal Lahir')
                            ->required(),
                        Forms\Components\Select::make('jenis_kelamin')
                            ->label('Jenis Kelamin')
                            ->options([
                                'Laki-laki' => 'Laki-laki',
                                'Perempuan' => 'Perempuan',
                            ])
                            ->required(),
                        Forms\Components\Select::make('agama')
                            ->label('Agama')
                            ->options([
                                'Islam' => 'Islam',
                                'Kristen' => 'Kristen',
                                'Katolik' => 'Katolik',
                                'Hindu' => 'Hindu',
                                'Buddha' => 'Buddha',
                                'Konghucu' => 'Konghucu',
                                'Lainnya' => 'Lainnya',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('anak_ke')
                            ->label('Anak Ke')
                            ->numeric()
                            ->required(),
                        Forms\Components\TextInput::make('jumlah_saudara')
                            ->label('Jumlah Saudara')
                            ->numeric()
                            ->required(),
                        Forms\Components\Select::make('status_dalam_keluarga')
                            ->label('Status dalam Keluarga')
                            ->options([
                                'kandung' => 'Kandung',
                                'angkat' => 'Angkat',
                            ])
                            ->required(),
                        Forms\Components\Textarea::make('alamat')
                            ->label('Alamat')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('no_hp_siswa')
                            ->label('Nomor HP Siswa')
                            ->tel()
                            ->maxLength(255)
                            ->nullable(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Data Asal Sekolah')
                    ->schema([
                        Forms\Components\TextInput::make('asal_sekolah')
                            ->label('Asal Sekolah')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('alamat_sekolah')
                            ->label('Alamat Sekolah')
                            ->maxLength(255)
                            ->columnSpanFull()
                            ->nullable(),
                    ])
                    ->columns(1),


                Forms\Components\Section::make('Data Orang Tua / Wali')
                    ->schema([
                        Forms\Components\TextInput::make('nama_ayah')
                            ->label('Nama Ayah')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('nama_ibu')
                            ->label('Nama Ibu')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('alamat_ayah')
                            ->label('Alamat Ayah')
                            ->maxLength(255)
                            ->nullable(),
                        Forms\Components\Textarea::make('alamat_ibu')
                            ->label('Alamat Ibu')
                            ->maxLength(255)
                            ->nullable(),
                        Forms\Components\TextInput::make('no_hp_ayah')
                            ->label('Nomor HP Ayah')
                            ->tel()
                            ->maxLength(255)
                            ->nullable(),
                        Forms\Components\TextInput::make('no_hp_ibu')
                            ->label('Nomor HP Ibu')
                            ->tel()
                            ->maxLength(255)
                            ->nullable(),
                        Forms\Components\TextInput::make('pekerjaan_ayah')
                            ->label('Pekerjaan Ayah')
                            ->maxLength(255)
                            ->nullable(),
                        Forms\Components\TextInput::make('pekerjaan_ibu')
                            ->label('Pekerjaan Ibu')
                            ->maxLength(255)
                            ->nullable(),
                        Forms\Components\TextInput::make('pendidikan_ayah')
                            ->label('Pendidikan Ayah')
                            ->maxLength(255)
                            ->nullable(),
                        Forms\Components\TextInput::make('pendidikan_ibu')
                            ->label('Pendidikan Ibu')
                            ->maxLength(255)
                            ->nullable(),
                        Forms\Components\TextInput::make('penghasilan_ayah')
                            ->label('Penghasilan Ayah')
                            ->maxLength(255)
                            ->nullable(),
                        Forms\Components\TextInput::make('penghasilan_ibu')
                            ->label('Penghasilan Ibu')
                            ->maxLength(255)
                            ->nullable(),
                    ])
                    ->columns(2),


                Forms\Components\Section::make('Dokumen')
                    ->schema([
                        Forms\Components\FileUpload::make('pas_foto')
                            ->label('Pas Foto')
                            ->nullable()
                            ->directory('pendaftaran')
                            ->visibility('public'),
                        Forms\Components\FileUpload::make('akta')
                            ->label('Akta Kelahiran')
                            ->nullable()
                            ->directory('pendaftaran')
                            ->visibility('public'),
                        Forms\Components\FileUpload::make('kk')
                            ->label('Kartu Keluarga (KK)')
                            ->nullable()
                            ->directory('pendaftaran')
                            ->visibility('public'),
                        Forms\Components\FileUpload::make('ktp')
                            ->label('KTP Orang Tua / Wali')
                            ->nullable()
                            ->directory('pendaftaran')
                            ->visibility('public'),
                        Forms\Components\FileUpload::make('ijazah_tk')
                            ->label('Ijazah TK / Surat Keterangan')
                            ->nullable()
                            ->directory('pendaftaran')
                            ->visibility('public'),
                    ])
                    ->columns(1),
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
                Tables\Columns\TextColumn::make('nama_lengkap')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tempat_lahir')
                    ->label('Tempat Lahir')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_lahir')
                    ->label('Tanggal Lahir')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status_pendaftaran')
                    ->label('Status Pendaftaran')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) { // Memberi warna badge berdasarkan status
                        'proses' => 'info',
                        'diterima' => 'success',
                        'ditolak' => 'danger',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('keterangan')
                    ->label('Keterangan')
                    ->limit(50)
                    ->tooltip(fn(?string $state): ?string => $state ?? '')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->label('verifikasi'),
                Tables\Actions\EditAction::make()
                    ->visible(fn($record) => $record->status_pendaftaran === 'ditolak')
                    ->label(fn($record) => $record->status_pendaftaran === 'ditolak' ? 'Perbaiki' : 'Edit'),
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
            'index' => Pages\ListPendaftarans::route('/'),
            'create' => Pages\CreatePendaftaran::route('/create'),
            'view' => Pages\ViewPendaftaran::route('/{record}'),
            'edit' => Pages\EditPendaftaran::route('/{record}/edit'),
        ];
    }
}
