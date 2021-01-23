<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use Sluggable;

    const IS_DRAFT = 0;
    const IS_PUBLIC = 1;

    protected $fillable = ['title', 'content'];

    public function category()
    {
        return $this->hasOne(Category::class);
    }

    public function author()
    {
        return $this->hasOne(User::class);
    }

    public function tags()
    { // many to many
        return $this->belongsToMany(
            Tag::class, //модель с которой связываемся
            'post_tags', // таблица через которую будет связь с тегами
            'post_id',
            'tag_id'
        );
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public static function addPost($fields)
    {
        $post = new static;
        $post->fill($fields);
        $post->user_id = 1;
        $post->save();

        return $post;
    }

    public function editPost($fields)
    {
        $this->fill($fields);
        $this->save();
    }

    public function removePost()
    {//return
        $this->delete();
    }

    public function uploadImage($image)
    {
        if ($image == null) {
        }
        Storage::delete('uploads/' . $this->image);
        $filename = str_random(10) . '.' . $image->extension();
        $image->saveAs('uploads', $filename); // путь относительно public
        $this->image = $filename;
        $this->save();
    }

    public function getImage()
    {
        if($this->image = null) {
            return '/img/no-img.png';
        } else {
            return '/uploads/' . $this->image;
        }

    }

    public function setCategory($id)
    {
        if ($id == null) {
        }
        $this->category_id = $id;
        $this->save();
    }

    public function setTags($ids)
    {
        if ($ids = null) {
        }

        $this->tags()->sync($ids);
    }

    public function setDraft()
    {
        $this->status = Post::IS_DRAFT;
        $this->save();
    }

    public function setStatus()
    {
        $this->status = Post::IS_PUBLIC;
        $this->save();
    }

    public function toggleStatus($value)
    {
        if ($value = null) {
            return $this->setDraft();
        } else {
            return $this->setStatus();
        }
    }

    public function setFeatured()
    {
        $this->is_featured = 1;
        $this->save();
    }

    public function setStandart()
    {
        $this->is_featured = 0;
        $this->save();
    }

    public function toggleFeatured($value)
    {
        if ($value = null) {
            return $this->setFeatured();
        } else {
            return $this->setStandart();
        }
    }


}
