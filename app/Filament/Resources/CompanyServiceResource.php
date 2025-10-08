<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyServiceResource\Pages;
use App\Filament\Resources\CompanyServiceResource\RelationManagers;
use App\Models\CompanyService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompanyServiceResource extends Resource
{
    protected static ?string $model = CompanyService::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationLabel = '企業サービス管理';

    protected static ?string $modelLabel = '企業サービス';

    protected static ?string $pluralModelLabel = '企業サービス';

    protected static ?string $navigationGroup = 'マッチング管理';

    protected static ?int $navigationSort = 11;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('企業')
                    ->relationship('user', 'name', fn (Builder $query) => $query->where('role', 'company'))
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->label('タイトル')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('category')
                    ->label('カテゴリ')
                    ->options([
                        '観光振興' => '観光振興',
                        '子育て支援' => '子育て支援',
                        'DX推進' => 'DX推進',
                        'インフラ整備' => 'インフラ整備',
                        '地域活性化' => '地域活性化',
                        '環境・エネルギー' => '環境・エネルギー',
                        'その他' => 'その他',
                    ])
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->label('サービス・技術の詳細')
                    ->required()
                    ->rows(5)
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('case_studies')
                    ->label('導入実績・事例')
                    ->rows(4)
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('strengths')
                    ->label('自社の強み')
                    ->rows(4)
                    ->columnSpanFull(),
                Forms\Components\Select::make('status')
                    ->label('公開状態')
                    ->options([
                        'draft' => '下書き',
                        'published' => '公開',
                    ])
                    ->default('published')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.companyProfile.company_name')
                    ->label('企業名')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('タイトル')
                    ->searchable()
                    ->limit(30)
                    ->sortable(),
                Tables\Columns\TextColumn::make('category')
                    ->label('カテゴリ')
                    ->badge()
                    ->colors([
                        'info' => '観光振興',
                        'success' => '子育て支援',
                        'warning' => 'DX推進',
                        'danger' => 'インフラ整備',
                        'primary' => '地域活性化',
                        'secondary' => '環境・エネルギー',
                    ])
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('公開状態')
                    ->badge()
                    ->colors([
                        'secondary' => 'draft',
                        'success' => 'published',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'draft' => '下書き',
                        'published' => '公開',
                        default => $state,
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('登録日時')
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('カテゴリ')
                    ->options([
                        '観光振興' => '観光振興',
                        '子育て支援' => '子育て支援',
                        'DX推進' => 'DX推進',
                        'インフラ整備' => 'インフラ整備',
                        '地域活性化' => '地域活性化',
                        '環境・エネルギー' => '環境・エネルギー',
                        'その他' => 'その他',
                    ]),
                Tables\Filters\SelectFilter::make('status')
                    ->label('公開状態')
                    ->options([
                        'draft' => '下書き',
                        'published' => '公開',
                    ]),
            ])
            ->actions([
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
            'index' => Pages\ListCompanyServices::route('/'),
            'create' => Pages\CreateCompanyService::route('/create'),
            'edit' => Pages\EditCompanyService::route('/{record}/edit'),
        ];
    }
}
