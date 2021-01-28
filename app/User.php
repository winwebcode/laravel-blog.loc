<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email',
    ];

    const IS_ACTIVE = 0;
    const IS_BANNED = 1;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        // один ко многим
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public static function add($fields)
    {
        $user = new static;
        $user->fill($fields);
        $user->save();

        return $user;
    }

    public function generatePassword($password)
    {
        if($password != null) {
            $this->password = bcrypt($password);
            $this->save();
        }
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }

    public function remove()
    {
        $this->removeAvatar(); //удаляем аватар если есть
        $this->delete();
    }

    public function uploadAvatar($image)
    {
        if ($image == null) {
            return;
        }
        $this->removeAvatar(); //удаляем аватар если есть
        //dd(get_class_methods($image));

        $filename = str_random(10) . '.' . $image->extension();
        $image->storeAs('uploads', $filename); // путь относительно public
        $this->avatar = $filename;
        $this->save();
    }

    public function removeAvatar()
    {
        if ($this->avatar != null) { //avatar поступает из метода store
            Storage::delete('uploads/' . $this->avatar); //удаление существующего аватара если он есть
        }
    }

    public function getAvatar()
    {
        if($this->avatar == null) {
            return '/img/no-user-img.jpg';
        } else {
            return '/uploads/' . $this->avatar;
        }

    }

    public function makeAdmin()
    {
        $this->is_admin = 1;
    }

    public function makeNormal()
    {
        $this->is_admin = 0;
    }

    public function toggleAdmin($value)
    {
        if($value == null) {
            return $this->makeNormal();
        } else {
           return $this->makeAdmin();
        }
    }

    public function ban()
    {
        $this->status = User::IS_BANNED;
        $this->save();
    }

    public function unban()
    {
        $this->status = User::IS_ACTIVE;
        $this->save();
    }

    public function toggleBan($value)
    {
        if($value == null) {
            $this->unban();
        } else {
            $this->ban();
        }
    }
}
