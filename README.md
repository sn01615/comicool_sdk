# comicool_sdk
可米酷API SDK PHP版


```php
use Comicool\ComicoolClient;

$client = new ComicoolClient();
$client->setClientId('aaa');
$client->setSecret('xxx');

# 获取漫画列表
$last = null;
$comics = $client->getComics($last);

# 获取漫画详情
$comicInfo = $client->getComic($comic->id);

# 获取漫画章节列表
$comicChapters = $client->getComicChapters($comic->id, $comic_last);

# 获取漫画章节内容
$chapterInfo = $client->getComicChapter($comic->id, $chapter->id);

```
