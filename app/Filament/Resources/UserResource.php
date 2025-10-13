<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'ユーザー管理';

    protected static ?string $modelLabel = 'ユーザー';

    protected static ?string $pluralModelLabel = 'ユーザー';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('名前')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label('メールアドレス')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->label('電話番号')
                    ->tel()
                    ->maxLength(20),
                Forms\Components\Select::make('role')
                    ->label('ロール')
                    ->options([
                        'municipality' => '首長',
                        'company' => '企業',
                        'admin' => '管理者',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('password')
                    ->label('パスワード')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => filled($state) ? bcrypt($state) : null)
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $context): bool => $context === 'create')
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_approved')
                    ->label('承認済み')
                    ->default(false),
                Forms\Components\DateTimePicker::make('email_verified_at')
                    ->label('メール確認日時'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('名前')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('メールアドレス')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('電話番号')
                    ->searchable(),
                Tables\Columns\TextColumn::make('role')
                    ->label('ロール')
                    ->badge()
                    ->colors([
                        'success' => 'municipality',
                        'warning' => 'company',
                        'danger' => 'admin',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'municipality' => '首長',
                        'company' => '企業',
                        'admin' => '管理者',
                        default => $state,
                    })
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_approved')
                    ->label('承認状態')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('登録日時')
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),
                Tables\Columns\IconColumn::make('deleted_at')
                    ->label('削除済み')
                    ->boolean()
                    ->sortable()
                    ->trueIcon('heroicon-o-trash')
                    ->falseIcon('heroicon-o-check-circle')
                    ->trueColor('danger')
                    ->falseColor('success'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->label('ロール')
                    ->options([
                        'municipality' => '首長',
                        'company' => '企業',
                        'admin' => '管理者',
                    ]),
                Tables\Filters\TernaryFilter::make('is_approved')
                    ->label('承認済み')
                    ->placeholder('すべて')
                    ->trueLabel('承認済み')
                    ->falseLabel('未承認'),
                Tables\Filters\TrashedFilter::make()
                    ->label('削除済み'),
            ])
            ->actions([
                Tables\Actions\Action::make('approve')
                    ->label('承認')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->action(fn (User $record) => $record->update(['is_approved' => true]))
                    ->visible(fn (User $record) => !$record->is_approved)
                    ->requiresConfirmation(),
                Tables\Actions\Action::make('reject')
                    ->label('却下')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->action(fn (User $record) => $record->update(['is_approved' => false]))
                    ->visible(fn (User $record) => $record->is_approved)
                    ->requiresConfirmation(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
