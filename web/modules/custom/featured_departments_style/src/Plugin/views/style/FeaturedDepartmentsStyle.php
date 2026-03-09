<?php

namespace Drupal\featured_departments_style\Plugin\views\style;

use Drupal\views\Plugin\views\style\StylePluginBase;

/**
 * @ViewsStyle(
 *   id = "featured_departments_style",
 *   title = @Translation("Featured Departments Custom Style"),
 *   help = @Translation("Custom style for featured departments."),
 *   theme = "views_view_featured_departments_style"
 * )
 */
class FeaturedDepartmentsStyle extends StylePluginBase {

  protected function defineOptions() {
    $options = parent::defineOptions();
    return $options;
  }

}