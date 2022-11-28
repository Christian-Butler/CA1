<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'user_role');
    }

    public function authoriseRoles($roles) 
    {
        if(is_array($roles)){
            return $this->hasAnyRole($roles) || 
            abort (401, 'This action is unathorised');
        }
        return $this->hasRole($roles) || 
        abort(401, 'this action is unauthorised');
    }

    public function hasRole($role)
    {
        return null !== $this->roles()-where('name', $role)-first();
    }

    public function hasanyRole($roles)
    {
        return null !== $this->roles()-whereIn('name', $roles)-first();
    }

}
