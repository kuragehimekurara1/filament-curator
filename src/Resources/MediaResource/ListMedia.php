<?php

namespace Awcodes\Curator\Resources\MediaResource;

use Exception;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ListMedia extends ListRecords
{
    public static function getResource(): string
    {
        return config('curator.media_resource');
    }

    public function getTitle(): string
    {
        return Str::headline(config('curator.model_plural_label'));
    }

    /**
     * @throws Exception
     */
    public function getHeaderActions(): array
    {
        return [
            Action::make('toggle-table-view')
                ->color('gray')
                ->label(function (): string {
                    return Session::get('tableLayout')
                        ? __('curator::tables.actions.toggle_table_list')
                        : __('curator::tables.actions.toggle_table_grid');
                })
                ->icon(function (): string {
                    return Session::get('tableLayout')
                        ? 'heroicon-s-queue-list'
                        : 'heroicon-s-squares-2x2';
                })
                ->action(function (): void {
                    ray(Session::get('tableLayout'));
                    Session::put('tableLayout', !Session::get('tableLayout'));
                }),
            CreateAction::make(),
        ];
    }
}
