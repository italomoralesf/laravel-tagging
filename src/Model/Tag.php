<?php namespace Conner\Tagging\Model;

use Conner\Tagging\Contracts\TaggingUtility;
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Copyright (C) 2014 Robert Conner
 */
class Tag extends Eloquent
{

    public $timestamps = false;
    protected $softDelete = false;
    public $fillable = ['name'];
    protected $taggingUtility;

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);

        if (function_exists('config') && $connection = config('tagging.connection')) {
            $this->connection = $connection;
        }

        $this->taggingUtility = app(TaggingUtility::class);
    }

    /**
     * (non-PHPdoc)
     * @see \Illuminate\Database\Eloquent\Model::save()
     */
    public function save(array $options = array())
    {
        $validator = app('validator')->make(
            array('name' => $this->name),
            array('name' => 'required|min:1')
        );

        if ($validator->passes()) {
            $normalizer = config('tagging.normalizer');
            $normalizer = $normalizer ?: [$this->taggingUtility, 'slug'];

            $this->slug = call_user_func($normalizer, $this->name);
            return parent::save($options);
        } else {
            throw new \Exception('Tag Name is required');
        }
    }

    /**
     * Set the name of the tag : $tag->name = 'myname';
     *
     * @param string $value
     */
    public function setNameAttribute($value)
    {
        $displayer = config('tagging.displayer');
        $displayer = empty($displayer) ? '\Illuminate\Support\Str::title' : $displayer;

        $this->attributes['name'] = call_user_func($displayer, $value);
    }

    /**
     * Look at the tags table and delete any tags that are no londer in use by any taggable database rows.
     *
     * @return int
     */
    public static function deleteUnused()
    {
        return (new static )->newQuery()
            ->where('count', '=', 0)
            ->delete();
    }
}
