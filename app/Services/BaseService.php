<?php namespace App\Services;

use Illuminate\Foundation\Bus\DispatchesCommands;

class BaseService
{
    use DispatchesCommands;

    protected function getRepo()
    {
        return null;
    }

    public function bulk($ids, $action)
    {
        if ( ! $ids) {
            return 0;
        }

        $entities = $this->getRepo()->findByPublicIdsWithTrashed($ids);

        foreach ($entities as $entity) {
            $this->getRepo()->$action($entity);
        }

        return count($entities);
    }
}
