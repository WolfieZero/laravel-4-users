
Laravel 4 - Users
===============================================================================

Based on:

- [Authentication With Laravel 4 - Tuts+ Code Tutorial](http://j.mp/OsxJjR)

A basic L4 app to register users safely, allow them acces to secure parts of
the site and edit their profile. I use this repo to mess around with user type
stuff and adding things that interest my simple mind.


Installation
-------------------------------------------------------------------------------

This is onyl a demo app to show off code, but if you like to install then
follow these steps (making sure you have the
[basic requirements](http://laravel.com/docs/installation)):

1. `git clone` the repo
2. `cd` into the newly created directory and run `composer install` (presuming
   you have it installed and accessed globally)
3. Update database config in `app/config/database.php`
   - You can also add a local config by folling the
     [official config guide](http://laravel.com/docs/configuration)
4. Run `php artisan migrate` in the root of the project to add new tables to
   the DB (providing your configs are correct and you added the DB)
5. Then run `php artisan serve` to run the server and boom!


License
-------------------------------------------------------------------------------

The Laravel framework is open-sourced software licensed under the
[MIT license](http://opensource.org/licenses/MIT)
