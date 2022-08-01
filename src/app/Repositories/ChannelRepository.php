<?php

namespace App\Repositories;


use App\Interfaces\ChannelRepoInterface;
use App\Models\Channel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @property Builder $model
 */
class ChannelRepository implements ChannelRepoInterface
{

    public function __construct()
    {
        $this->model = Channel::query();
    }

    public function index() : Collection
    {
        return $this->model->get();
    }

    public function store($name) : Model
    {
       return $this->model->create([
            'name' => $name,
            'slug' => Str::slug($name),
        ]);
    }

    public function update($id, $name) : bool
    {
        return $this->model->find($id)->update([
            'name' => $name,
            'slug' => Str::slug($name)
        ]);
    }

    public function destroy($id): bool
    {
        return $this->model->find($id)->delete();
    }
}
