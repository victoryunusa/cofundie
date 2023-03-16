<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait Relationships
{
    public function countRelationships($model, $relationships): array
    {
        $record = new \stdClass();
        $record->model = $model;
        $record->relationships = $relationships;

        $counter = [];

        foreach ((array) $record->relationships as $relationship => $text) {
            if (!$c = $model->$relationship()->count()) {
                continue;
            }

            $counter[] = $c . ' ' . strtolower(trans_choice($text, ($c > 1) ? 2 : 1));
        }

        return $counter;
    }

    /**
     * Mass delete relationships with events being fired.
     *
     * @param  $model
     * @param  $relationships
     * @param bool $permanently
     */
    public function deleteRelationships($model, $relationships, bool $permanently = false): void
    {
        $record = new \stdClass();
        $record->model = $model;
        $record->relationships = $relationships;

        foreach ((array) $record->relationships as $relationship) {
            if (empty($model->$relationship)) {
                continue;
            }

            $items = [];
            $relation = $model->$relationship;

            if ($relation instanceof Collection) {
                $items = $relation->all();
            } else {
                $items[] = $relation;
            }

            $function = $permanently ? 'forceDelete' : 'delete';

            foreach ((array) $items as $item) {
                $item->$function();
            }
        }
    }


    /**
     * If it has relation model can not delete
     * @param Model $model
     * @param array $relations
     * @return void
     * @throws \Exception
     */
    public function checkDeletable(Model $model, array $relations)
    {
        $counter = $this->countRelationships($model, $relations);

        if ($relationships = $counter) {
            $message = __("Warning: You are not allowed to delete <b>:name</b> because it has <b>:text</b> related.", ['name' => $model->name, 'text' => ucwords(implode(', ', $relationships))]);

            throw new \Exception($message);
        }
    }
}
