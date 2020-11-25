<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $id = 'id_user';
    protected $table = 'user';

    protected $fillable = [
        'nom_user',
        'ape_user',
        'carnet_user',
        'dep_user',
        'email_user',
        'pass_user',
        'pregunta',
        'respuesta',
        'cel_user',
        'tipo_user',
    ];

    protected $hidden = [
        'pass_user',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
