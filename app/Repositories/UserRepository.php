<?php

namespace App\Repositories;
use App\Models\User;
class UserRepository
{
   
    public function all()
    {
        return User::all();
    }

    public function find($id)
    {
        $User = User::find($id);
         if (!$User) {
            return false;
        }
        return true;
        
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update($id, array $data)
    {
        $User = User::findOrFail($id);
        $User->update($data);
        return $User;
    }

    public function delete($id)
    {
        $User = User::findOrFail($id);
        $User->delete();
        return true;
    }
}
