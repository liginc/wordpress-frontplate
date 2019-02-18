<?php

class AcfCustomJsonData
{
  private static $acf_custom_json_data;

  private static $theme_path = '/inc/acf-json';

  private function __construct()
  {
  }

  public static function get_json_data_path($default_path)
  {
    $path = get_stylesheet_directory() . self::$theme_path;
    if (!file_exists($path)) mkdir($path);
    return $path;
  }
}

/**
 * acf設定を保存
 * 2018.05.12
 * author:ryota moiryama
 */
function my_acf_json_save_point($path)
{
  return AcfCustomJsonData::get_json_data_path($path);
}
//add_filter('acf/settings/save_json', 'my_acf_json_save_point');

/**
 * acf設定を呼び出し
 * 2018.05.12
 * author:ryota moiryama
 */
function my_acf_json_load_point($paths)
{
  return array(AcfCustomJsonData::get_json_data_path($paths));
}
//add_filter('acf/settings/load_json', 'my_acf_json_load_point');

/**
 * ダッシュボードにオプションページを設置
 * 2018.05.12
 * author:ryota moiryama
 */
function display_acf_option_page()
{
  if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
      'page_title' => "OPTION",
      'menu_title' => "OPTION",
      'menu_slug' => 'acf-options',
    ));
  }
}
//add_action('init','display_acf_option_page');