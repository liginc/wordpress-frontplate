<?php
/**
 * The header for our theme.
 *
 * @see https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <title><?php wp_title('|'); ?></title>
  <base href="/">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta property="og:locale" content="ja_JP">
  <meta property="fb:admins" content="">
  <meta property="og:title" content="">
  <meta property="og:description" content="">
  <meta property="og:url" content="">
  <meta property="og:site_name" content="">
  <meta property="og:type" content="blog">
  <meta property="og:image" content="<?php echo resolve_asset_url('/images/common/logo_ogp.png'); ?>">

  <link rel="shortcut icon" href="<?php echo resolve_asset_url('/images/favicon.ico'); ?>">
  <link rel="apple-touch-icon-precomposed" href="<?php echo resolve_asset_url('/images/apple-touch-icon-precomposed.png'); ?>">
  <link rel="stylesheet" href="<?php echo resolve_asset_url('/css/style.css'); ?>">

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
