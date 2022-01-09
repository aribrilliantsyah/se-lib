<?php

namespace App\Helpers;

class Menu
{

    public $html = '';

    public function init()
    {
        $this->html = '<div class="collapse navbar-collapse" id="sidenav-collapse-main">';
        return $this;
    }

    public function item($title, $icon, $url, $isActive)
    {
        $this->html .= '<li class="nav-item">
      <a class="nav-link ' . ($isActive ? 'active' : '') . '" href="' . url($url) . '">
        <i class="' . $icon . '"></i>
        <span class="nav-link-text">' . $title . '</span>
      </a>
    </li>';

        return $this;
    }

    public function divinder($title)
    {
        $this->html .= '<hr class="my-3">
    <h6 class="navbar-heading p-0 text-muted">
      <span class="docs-normal">' . $title . '</span>
    </h6>';
        return $this;
    }

    public function start_group()
    {
        $this->html .= '<ul class="navbar-nav">';
        return $this;
    }

    public function end_group()
    {
        $this->html .= '</ul>';
        return $this;
    }

    public function to_html()
    {
        $this->html .= '</div>';
        return $this->html;
    }
}
