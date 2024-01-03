<?php

namespace Domain\Products\Data;

use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\Unique;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class CategoryData extends Data
{
    public function __construct(
        public ?string $id,
        #[Unique('categories', 'title')]
        public string $title,
        #[Exists('categories', 'id')]
        public string|Optional|null $parent_id,
        public ?Carbon $created_at,
        public ?Carbon $updated_at,
        public ?Carbon $deleted_at,
    ) {
    }

    /** @return array<mixed> */
    public function with(): array
    {
        if ($this->id) {
            return [
                'endpoints' => [
                    'show' => route('categories.show', $this->id),
                    'update' => route('categories.update', $this->id),
                    'delete' => route('categories.destroy', $this->id),
                ],
            ];
        }

        return [];
    }
}
