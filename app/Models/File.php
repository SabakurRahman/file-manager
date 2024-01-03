<?php

namespace App\Models;

use App\Trait\HasCreatorAndUpdater;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class File extends Model
{
    use HasFactory,HasCreatorAndUpdater,NodeTrait,SoftDeletes;

  public function isOwnedBy($id): bool
  {
      return $this->created_by == $id;
  }




}
