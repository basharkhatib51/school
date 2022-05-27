<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class ModelObserver
{
    private $userID;


    public function __construct()
    {
        $user = Auth::user();
        if ($user)
            $this->userID = $user->id;
    }

    public function saving($model)
    {
        $model->updated_by = $this->userID;
    }

    public function saved($model)
    {
        $model->updated_by = $this->userID;
    }

    public function updating($model)
    {
        $model->updated_by = $this->userID;
    }

    public function updated($model)
    {
        $model->updated_by = $this->userID;
    }

    public function creating($model)
    {
        $model->created_by = $this->userID;
    }

    public function created($model)
    {
        $model->created_by = $this->userID;
    }

    public function removing($model)
    {
        $model->deleted_by = $this->userID;
    }

    public function removed($model)
    {
        $model->deleted_by = $this->userID;
    }
}
