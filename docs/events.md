Events
============

The `Taggable` trait will fire off two events.

```php
Italomoralesf\Tagging\Events\TagAdded;

Italomoralesf\Tagging\Events\TagRemoved;
```

You can add listeners and track these events.

```php
\Event::listen(Italomoralesf\Tagging\Events\TagAdded::class, function($article){
	\Log::debug($article->title . ' was tagged');
});
```