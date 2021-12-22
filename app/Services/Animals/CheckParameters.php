<?php
declare(strict_types=1);

namespace App\Services\Animals;

use App\Models\AnimalUser;

class CheckParameters
{
    public function decrementProperties(array $decrementIDs, $property)
    {
        foreach ($decrementIDs as $id) {
            AnimalUser::find($id)?->decrement($property, 1, [$property . '_decrement_at' => now()]);
        }
    }

    public function incrementProperty(int $animal_id, string $property)
    {
        $item = AnimalUser::where('user_id', auth()->user()->id)
            ->where('animal_id', $animal_id)
            ->get()
            ->first();

        if ($item->canIncrement($property)) {
            $item->increment($property, 1, [$property . '_increment_at' => now()]);
        }
    }

    public function canIncrementProperty(int $animal_id, string $property)
    {
        return AnimalUser::where('user_id', auth()->user()->id)
            ->where('animal_id', $animal_id)
            ->get()
            ->first()
            ->canIncrement($property);
    }

    public function resetAliveAttribute(array $animalsId)
    {
        foreach ($animalsId as $animal_id) {
            AnimalUser::where('id', $animal_id)?->update(['alive' => 0]);
        }
    }
}
