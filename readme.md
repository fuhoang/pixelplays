# Pixel Plays

Current version: 0.0.1 beta

The official home of Let's Play series #PixelPlays. We also like cake. And blogging about stuff in geek-culture; so everything animation, comics, gaming and more! Check out our blog and drop us a line over at www.TheActionPixel.com!

Pixel Plays is a backend CMS API which manage youtube videos putting them into cateogry, adding a new video content, updating and delelation.

## Installation

* `get clone https://github.com/fuhoang/pixelplays.git projectname`
* `cd projectname`
* `composer install`
* `php artisan key:generate`
* `php artisan migrate`
* `php artisan db:seed --class=CategoryTableSeeder`
* `php artisan serve` to start the app on http://localhost:8000/




