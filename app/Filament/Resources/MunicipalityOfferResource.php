<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MunicipalityOfferResource\Pages;
use App\Filament\Resources\MunicipalityOfferResource\RelationManagers;
use App\Models\MunicipalityOffer;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MunicipalityOfferResource extends Resource
{
    protected static ?string $model = MunicipalityOffer::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-path-rounded-square';

    protected static ?string $navigationLabel = '首長マッチング管理';

    protected static ?string $modelLabel = '首長オファー';

    protected static ?string $pluralModelLabel = '首長オファー';

    protected static ?string $navigationGroup = 'マッチング管理';

    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('sender_id')
                    ->label('送信者（首長）')
                    ->relationship('sender', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('receiver_id')
                    ->label('受信者（首長）')
                    ->relationship('receiver', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Textarea::make('message')
                    ->label('オファーメッセージ')
                    ->rows(4)
                    ->columnSpanFull(),
                Forms\Components\Select::make('status')
                    ->label('ステータス')
                    ->options([
                        'pending' => '新規',
                        'contacted' => '対応中',
                        'completed' => '完了',
                    ])
                    ->default('pending')
                    ->required(),
                Forms\Components\Textarea::make('note')
                    ->label('管理者メモ')
                    ->rows(4)
                    ->columnSpanFull()
                    ->helperText('管理者のみ閲覧可能'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sender.name')
                    ->label('送信者')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sender.municipalityProfile.city')
                    ->label('送信者自治体')
                    ->searchable(),
                Tables\Columns\TextColumn::make('receiver.name')
                    ->label('受信者')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('receiver.municipalityProfile.city')
                    ->label('受信者自治体')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('ステータス')
                    ->badge()
                    ->colors([
                        'warning' => 'pending',
                        'primary' => 'contacted',
                        'success' => 'completed',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => '新規',
                        'contacted' => '対応中',
                        'completed' => '完了',
                        default => $state,
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('オファー日時')
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
                Tables\Filters\SelectFilter::make('status')
                    ->label('ステータス')
                    ->options([
                        'pending' => '新規',
                        'contacted' => '対応中',
                        'completed' => '完了',
                    ]),
                Tables\Filters\TrashedFilter::make()
                    ->label('削除済み'),
            ])
            ->actions([
                Tables\Actions\Action::make('contacted')
                    ->label('対応中にする')
                    ->icon('heroicon-o-phone')
                    ->color('primary')
                    ->action(fn (MunicipalityOffer $record) => $record->update(['status' => 'contacted']))
                    ->visible(fn (MunicipalityOffer $record) => $record->status === 'pending')
                    ->requiresConfirmation(),
                Tables\Actions\Action::make('completed')
                    ->label('完了にする')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->action(fn (MunicipalityOffer $record) => $record->update(['status' => 'completed']))
                    ->visible(fn (MunicipalityOffer $record) => $record->status !== 'completed')
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
            'index' => Pages\ListMunicipalityOffers::route('/'),
            'create' => Pages\CreateMunicipalityOffer::route('/create'),
            'edit' => Pages\EditMunicipalityOffer::route('/{record}/edit'),
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
