<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyOfferResource\Pages;
use App\Filament\Resources\CompanyOfferResource\RelationManagers;
use App\Models\CompanyOffer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompanyOfferResource extends Resource
{
    protected static ?string $model = CompanyOffer::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $navigationLabel = '企業マッチング管理';

    protected static ?string $modelLabel = '企業オファー';

    protected static ?string $pluralModelLabel = '企業オファー';

    protected static ?string $navigationGroup = 'マッチング管理';

    protected static ?int $navigationSort = 12;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('service_id')
                    ->label('企業サービス')
                    ->relationship('companyService', 'title')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('municipality_user_id')
                    ->label('送信者（自治体）')
                    ->relationship('municipality', 'name')
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
                Tables\Columns\TextColumn::make('municipality.name')
                    ->label('送信者（自治体）')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('municipality.municipalityProfile.city')
                    ->label('自治体名')
                    ->searchable(),
                Tables\Columns\TextColumn::make('companyService.title')
                    ->label('サービス名')
                    ->searchable()
                    ->limit(30)
                    ->sortable(),
                Tables\Columns\TextColumn::make('companyService.user.companyProfile.company_name')
                    ->label('企業名')
                    ->searchable(),
                Tables\Columns\TextColumn::make('companyService.category')
                    ->label('カテゴリ')
                    ->badge(),
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
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('ステータス')
                    ->options([
                        'pending' => '新規',
                        'contacted' => '対応中',
                        'completed' => '完了',
                    ]),
                Tables\Filters\SelectFilter::make('category')
                    ->label('カテゴリ')
                    ->relationship('companyService', 'category')
                    ->options([
                        '観光振興' => '観光振興',
                        '子育て支援' => '子育て支援',
                        'DX推進' => 'DX推進',
                        'インフラ整備' => 'インフラ整備',
                        '地域活性化' => '地域活性化',
                        '環境・エネルギー' => '環境・エネルギー',
                        'その他' => 'その他',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('contacted')
                    ->label('対応中にする')
                    ->icon('heroicon-o-phone')
                    ->color('primary')
                    ->action(fn (CompanyOffer $record) => $record->update(['status' => 'contacted']))
                    ->visible(fn (CompanyOffer $record) => $record->status === 'pending')
                    ->requiresConfirmation(),
                Tables\Actions\Action::make('completed')
                    ->label('完了にする')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->action(fn (CompanyOffer $record) => $record->update(['status' => 'completed']))
                    ->visible(fn (CompanyOffer $record) => $record->status !== 'completed')
                    ->requiresConfirmation(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListCompanyOffers::route('/'),
            'create' => Pages\CreateCompanyOffer::route('/create'),
            'edit' => Pages\EditCompanyOffer::route('/{record}/edit'),
        ];
    }
}
