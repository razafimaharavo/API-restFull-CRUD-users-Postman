<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersNaka extends Model
{
    use HasFactory;
    /**
     * Le nom de la table associée au modèle.
     *
     * @var string
     */
    protected $table = 'users_naka';
    
    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array
     */

    protected $fillable = ['Name', 'Email', 'Password'];
}
