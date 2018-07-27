Laravel Taggable Trait
============

Package based on rtconner/laravel-tagging

#### Original documentation in

[Laravel 5 Documentation](https://github.com/rtconner/laravel-tagging/tree/laravel-5)
[Laravel 4 Documentation](https://github.com/rtconner/laravel-tagging/tree/laravel-4)

#### Composer Install (for Laravel 5+)

***Original***

```shell
composer require rtconner/laravel-tagging "~2.2"
```

#### Install and then Run the migrations

The service provider does not load on every page load, so it should not slow down your app. In `config/app.php` You may add the the `TaggingServiceProvider` in the providers array as follows:

> If you're using Laravel 5.5+ let the package auto discovery make this for you.

```php
'providers' => [
	\Conner\Tagging\Providers\TaggingServiceProvider::class,
];
```
Then publish the configurations and migrations by:
```bash
php artisan vendor:publish --provider="Conner\Tagging\Providers\TaggingServiceProvider"
php artisan migrate
```

#### Setup your models
```php
class Article extends \Illuminate\Database\Eloquent\Model {
	use \Conner\Tagging\Taggable;
}
```

#### Quick Sample Usage

```php
$article = Article::with('tagged')->first(); // eager load

foreach($article->tags as $tag) {
	echo $tag->name . ' with url slug of ' . $tag->slug;
}

$article->tag('Gardening'); // attach the tag

$article->untag('Cooking'); // remove Cooking tag
$article->untag(); // remove all tags

$article->retag(array('Fruit', 'Fish')); // delete current tags and save new tags

$article->tagNames(); // get array of related tag names

Article::withAnyTag(['Gardening','Cooking'])->get(); // fetch articles with any tag listed

Article::withAllTags(['Gardening', 'Cooking'])->get(); // only fetch articles with all the tags

Article::withoutTags(['Gardening', 'Cooking'])->get(); // only fetch articles without all tags listed

Conner\Tagging\Model\Tag::where('count', '>', 2)->get(); // return all tags used more than twice

Article::existingTags(); // return collection of all existing tags on any articles
```

[More examples in the documentation](docs/usage-examples.md)


### Tag Groups

I eliminated the group function, the original package has this function

### Configure

[See config/tagging.php](config/tagging.php) for configuration options.

### Further Documentation

[See the docs/ folder](docs) for more documentation.

#### Upgrading Laravel 4 to 5

This library stores full model class names into the database. When you upgrade laravel and you add namespaces to your models, you will need to update the records stored in the database.
Alternatively you can override Model::$morphClass on your model class to match the string stored in the database.

#### Credits

 - Robert Conner - http://smartersoftware.net