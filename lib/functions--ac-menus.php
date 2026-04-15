<?php
//Define your menus here an use in your .twig templates

/* Markup Example
**(Hero = menuHero in your template)**
**(Hero = Hero when creating a menu in wordpress**
 <ul class="call-to-action-menu__list">
  {% for item in menuHero.get_items %}
    <li class="call-to-action-menu__item {{ item.classes | join(' ') }}">
      <a class="call-to-action-menu__link " href="{{ item.get_link }}">
        <span class="call-to-action-menu__text">{{ item.title }}</span>
      </a>
    </li>
  {% endfor %}
</ul>
 */

define('ACT_MENUS', serialize([
        'Primary',
        'Mobile',
        'Hero',
        'Service',
        'Categories'
    ]));

