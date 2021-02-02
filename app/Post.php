<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use Sluggable;

    const IS_DRAFT = 1;
    const IS_PUBLIC = 0;

    protected $fillable = ['title', 'content', 'date', 'description'];

    public function category()
    {
        // пост принадлежит 1 кат. , но 1 кат может иметь множество постов
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getAuthor()
    {
        if ($this->user_id != null) {
            return $this->author->name;
        } else {
            return null;
        }
    }

    public function getCategoryTitle()
    {
        if ($this->category != null) {
            return $this->category->title;
        } else {
            return 'Без категории';
        }
    }

    public function getCategoryID()
    {
        if ($this->category != null) {
            return $this->category->id;
        } else {
            return;
        }
    }

    public function getTagsTitles()
    {
        if (!$this->tags->isEmpty()) { //если не пусто
            return implode(', ', $this->tags->pluck('title')->all());
        } else {
            return 'Теги не установлены';
        }

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

    public static function add($fields)
    {
        $post = new static;
        $post->fill($fields);
        $post->user_id = 1;
        $post->save();

        return $post;
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }

    public function remove()
    {
        $this->removeImage();
        $this->delete();
    }

    public function removeImage()
    {
        if ($this->image != null) {
            Storage::delete('uploads/' . $this->image);
        }
    }

    public function uploadImage($image)
    {
        if ($image == null) {
            return;
        }
        $this->removeImage();
        $filename = str_random(10) . '.' . $image->extension();
        $image->storeAs('uploads', $filename); // путь относительно public
        $this->image = $filename;
        $this->save();
    }

    public function getImage()
    {
        if ($this->image == null) {
            return '/img/no-img.png';
        } else {
            return '/uploads/' . $this->image;
        }

    }

    public function setCategory($id)
    {
        if ($id == null) {
            return;
        }
        $this->category_id = $id;
        $this->save();
    }

    public function setTags($ids)
    {
        if ($ids == null) {
            return;
        }

        $this->tags()->sync($ids);
    }

    public function setDraft()
    {
        $this->status = Post::IS_DRAFT;
        $this->save();
    }

    public function setPublic()
    {
        $this->status = Post::IS_PUBLIC;
        $this->save();
    }

    public function toggleStatus($value)
    {
        if ($value == null) { // по умолчанию НЕ черновик
            return $this->setPublic(); //0
        } else {
            return $this->setDraft(); //1
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
        if ($value == null) { // по умолчанию вкл обычная запись
            return $this->setStandart(); //0
        } else {
            return $this->setFeatured();
        }
    }

    public function setDateAttribute($value)
    {
        $date = Carbon::createFromFormat('d/m/y', $value)->format('Y-m-d');
        $this->attributes['date'] = $date;
        return $date;
    }

    public function getDateAttribute($value)
    {
        $date = Carbon::createFromFormat('Y-m-d', $value)->format('d/m/y');
        $this->attributes['date'] = $date;
        return $date;
    }

    public function getDate()
    {
        $date = Carbon::createFromFormat('d/m/y', $this->date)->format('F d Y');
        $this->attributes['date'] = $date;
        return $date;
    }


    public function hasPrevious()
    {
        /*позднее статическое связывание сохраняет имя класса указанного в последнем "неперенаправленном вызове".
         В случае статических вызовов это явно указанный класс (обычно слева от оператора ::);
        в случае не статических вызовов это класс объекта. "Перенаправленный вызов" - это статический вызов, начинающийся с self::,
         parent::, static::
         * */
        // по типу Post::where('id', '<', $this->id)->max('id');
        return self::where('id', '<', $this->id)->max('id');
    }

    public function getPrevious()
    {
        $postID = $this->hasPrevious();
        return self::find($postID);


    }

    public function hasNext()
    { //след. пост существует? Возвращаем ID
        // return self::where('id', '<', $this->id)->max('id');
        return $this->where('id', '>', $this->id)->min('id');
    }

    public function getNext()
    {
        $postID = $this->hasNext();
        return self::find($postID);
    }

    public function related()
    {
        //посты текущей категории
        return self::all()->where('category_id', '=', $this->category_id)->except('$this->id');
    }

    public function featured()
    {
        //посты рекомендуемые
        return self::all()->where('is_featured', '=', '1')->except('$this->id');
    }

}
