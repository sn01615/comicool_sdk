# comicool_sdk
可米酷API SDK PHP版


```php
use Comicool\ComicoolClient;

$client = new ComicoolClient();
$client->setClientId('aaa');
$client->setSecret('xxx');

$last = null;
$comics = $client->getComics($last);

$comicInfo = $client->getComic($comic->id);

$comicChapters = $client->getComicChapters($comic->id, $comic_last);

$chapterInfo = $client->getComicChapter($comic->id, $chapter->id);

```
