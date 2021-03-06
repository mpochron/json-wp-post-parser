### JSON post parser

[![Travis](https://img.shields.io/travis/infinum/json-wp-post-parser.svg?style=for-the-badge)](https://github.com/infinum/json-wp-post-parser)
[![GitHub tag](https://img.shields.io/github/tag/infinum/json-wp-post-parser.svg?style=for-the-badge)](https://github.com/infinum/json-wp-post-parser)

JSON Post Parser plugin parses your content and saves it as JSON available in REST posts and pages endpoints.

## Description

When working on decoupled WordPress, while using one of the popular frameworks or libraries such as React, post content in pure HTML can be a bit of a problem. Having absolute links that point to the on-site resource would cause a page refresh. Which defeats the purpose of building with, for instance, React, which uses Link component to handle routes.
This is where having post served as JSON simplifies things, in that you can find all the links, and then replace them with the appropriate router alternative.

When you create a post and then save it, the parser will go through your rendered post and parse it in JSON, which will then be saved in `post_content_json` table in the `posts` table.
Other than parsing the post, this plugin registers the additional REST field called `post_content_json` which you can fetch by going to `wp-json/wp/v2/posts/` or `wp-json/wp/v2/pages/`.

If you want to expose your own custom post types to the REST endpoint, use the filter `json_post_parser_add_post_types`.

## Development Setup

```sh
npm i
```

or

```sh
yarn
```

```sh
composer install
```

## Precommit tests

This will run eslint, stylelint and phpcs tests.

```sh
npm run precommit
```

### Build

```sh
npm run build
```

### Unit tests

All the unit tests are located in the `\tests` folder. The unit testing is done via [PHPUnit](https://phpunit.de/). Feel free to add you own tests or check the existing one. You need to have at the most PHPUnit 6 for the tests to pass.

To initialize the testing environment locally go to the project root (where `phpunit.xml` resides) and run

```sh
sh bin/install-wp-tests.sh wordpress_test root '' 127.0.0.1 latest
```

This should create a temporary WordPress installation in the `/private/tmp/wordpress` folder. Be sure to set up the `wp-config.php` in the test WordPress install.

After that you can run plugin tests by writing

```sh
vendor/bin/phpunit
```

## WordPress Installation

Once you've built the plugin using npm, you can use code found in the `/build/` folder as a regular WordPress plugin.

1. Place `json-wp-post-parser` folder in the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

## Other usages

You can use parse methods in other plugins if you want to. Once you install the plugin you can use the `parse_content_to_json()` method to parse HTML to json parsed content.

```php

$parser = new \Json_WP_Post_Parser\Admin\Parse();

$parsed_content = $parser->parse_content_to_json( $html_content );
```

## Frequently Asked Questions

### Will all my posts automatically be parsed?

No. Upon plugin activation, you will see a prompt that will ask you if you want to update all your posts, pages, custom post types.
If you say yes, you'll be sent to a page where you'll see all your posts being resaved using AJAX.
The reason for this is that someone can have 1000+ posts, and doing bulk upgrade would fail (exhausted memory, timeout etc.).
By using AJAX we can trigger post saving asynchronously, which doesn't overload the system.

### How can I add my custom post types, so that rest route has it as well?

There is a built in filter hook which you can use called `json_wp_post_parser_add_post_types`. Say you have custom post type called `books`,
you'd add them like this:

```php
add_filter( 'json_wp_post_parser_add_post_types', 'my_slug_add_cpt_to_parser' );

function my_slug_add_cpt_to_parser( $post_types ) {
  // the $post_types parameter is an array of all post_types from the api_fields_init() method.
  $post_types[] = 'books';
  return $post_types;
}
```

Be aware that to access the custom post content of your custom post type, you'll have to enable its [REST capabilities](https://developer.wordpress.org/rest-api/extending-the-rest-api/adding-rest-api-support-for-custom-content-types/).

## Possible issues

When using post update to update all your posts, the default number of posts that are queried is 5000. This is done to optimize query performance. Because you should never use `'posts_per_page' => -1`. If you have more than 5000 posts then open `class-json-post-parser-admin.php` and change this number on line 84.

## Changelog

### 1.0.7

* Autoloader fix
* Removed unused packages
* Fix the unit testing

### 1.0.6

* Minor class fixes

### 1.0.5

* Linter fixes
* Class name fixes

### 1.0

* Initial release

## Credits

JSON post parser is maintained and sponsored by
[Infinum](https://www.infinum.co).

<img src="https://infinum.co/infinum.png" width="264">

## License

JSON post parser is Copyright © 2017 Infinum. It is free software, and may be redistributed under the terms specified in the LICENSE file.
