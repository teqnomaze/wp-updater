# Wordpress Updater
A class library for getting latest updates for Wordpress themes and plugins from a remote server.

### Installation
Install the package using [Composer](https://getcomposer.org/) by running the following command.

```sh
$ composer require teqnomaze/wp-updater
```

### Usage Instructions
This library can be used with both Wordpress theme and plugin

#### Theme Usage
```php
if ( is_admin() ) {

  // Create theme info class
  $product = ( new \Teqnomaze\WpUpdater\Product() )
    ->set_slug( 'my-theme' )
    ->set_remote_url( 'http://example.com/my-theme' )
    ->set_access_key( 'my-access-key' );
  
  // Instantiate theme updater class
  $updater = new \Teqnomaze\WpUpdater\Theme_Updater( $product );
  
  // Load all the required hooks
  $updater->load();

}
```

#### Plugin Usage
```php
if ( is_admin() ) {

  // Create theme info class
  $product = ( new \Teqnomaze\WpUpdater\Product() )
    ->set_slug( 'my-plugin' )
    ->set_basename( 'plugin/my-plugin.php' )
    ->set_remote_url( 'http://example.com/my-plugin' )
    ->set_access_key( 'my-access-key' );
  
  // Instantiate theme updater class
  $updater = new \Teqnomaze\WpUpdater\Plugin_Updater( $product );
  
  // Load all the required hooks
  $updater->load();

}
```
