<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* layout.twig */
class __TwigTemplate_a2660630d141baf008710e2043a179c50376c1c9ffcf45d5e8a544460880a833 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
<head>
<meta charset=\"utf-8\">
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, maximum-scale=1\">
<title>";
        // line 6
        $this->displayBlock('title', $context, $blocks);
        echo "-后台大平台</title>
<link rel=\"stylesheet\" href=\"http://lab.io/index.php/staic/layui/css/layui.css\">
</head>
<body class=\"layui-layout-body\">
<div class=\"layui-layout layui-layout-admin\">
  <div class=\"layui-header\">
    <div class=\"layui-logo\">后台大平台</div>
    <!-- 头部区域（可配合layui已有的水平导航） -->
    <ul class=\"layui-nav layui-layout-left\">
      <li class=\"layui-nav-item\"><a href=\"\">控制台</a></li>
      <li class=\"layui-nav-item\"><a href=\"\">用户管理</a></li>
      <li class=\"layui-nav-item\"><a href=\"\">客户管理</a></li>
    </ul>
    <ul class=\"layui-nav layui-layout-right\">
      <li class=\"layui-nav-item\">
        <a href=\"javascript:;\">
          <img src=\"http://t.cn/RCzsdCq\" class=\"layui-nav-img\">
          admin
        </a>
        <dl class=\"layui-nav-child\">
          <dd><a href=\"\">个人中心</a></dd>
          <dd><a href=\"\">安全设置</a></dd>
        </dl>
      </li>
      <li class=\"layui-nav-item\"><a href=\"\">退了</a></li>
    </ul>
  </div>
  
  ";
        // line 34
        echo twig_include($this->env, $context, "sidebar.twig");
        echo "
  
  <div class=\"layui-body\">
    <!-- 内容主体区域 -->
    <div style=\"padding: 15px;\">
      ";
        // line 39
        $this->displayBlock('body', $context, $blocks);
        // line 40
        echo "    </div>
  </div>
  
  <div class=\"layui-footer\">
    <!-- 底部固定区域 -->
    ©zeelis.com 2017-2021
  </div>
</div>
<script src=\"http://lab.io/index.php/staic/layui/layui.js\"></script>
<script>
layui.use('element', function(){var element = layui.element;});
</script>
</body>
</html>";
    }

    // line 6
    public function block_title($context, array $blocks = [])
    {
    }

    // line 39
    public function block_body($context, array $blocks = [])
    {
    }

    public function getTemplateName()
    {
        return "layout.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  102 => 39,  97 => 6,  80 => 40,  78 => 39,  70 => 34,  39 => 6,  32 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("<!DOCTYPE html>
<html>
<head>
<meta charset=\"utf-8\">
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, maximum-scale=1\">
<title>{% block title %}{% endblock %}-后台大平台</title>
<link rel=\"stylesheet\" href=\"http://lab.io/index.php/staic/layui/css/layui.css\">
</head>
<body class=\"layui-layout-body\">
<div class=\"layui-layout layui-layout-admin\">
  <div class=\"layui-header\">
    <div class=\"layui-logo\">后台大平台</div>
    <!-- 头部区域（可配合layui已有的水平导航） -->
    <ul class=\"layui-nav layui-layout-left\">
      <li class=\"layui-nav-item\"><a href=\"\">控制台</a></li>
      <li class=\"layui-nav-item\"><a href=\"\">用户管理</a></li>
      <li class=\"layui-nav-item\"><a href=\"\">客户管理</a></li>
    </ul>
    <ul class=\"layui-nav layui-layout-right\">
      <li class=\"layui-nav-item\">
        <a href=\"javascript:;\">
          <img src=\"http://t.cn/RCzsdCq\" class=\"layui-nav-img\">
          admin
        </a>
        <dl class=\"layui-nav-child\">
          <dd><a href=\"\">个人中心</a></dd>
          <dd><a href=\"\">安全设置</a></dd>
        </dl>
      </li>
      <li class=\"layui-nav-item\"><a href=\"\">退了</a></li>
    </ul>
  </div>
  
  {{ include('sidebar.twig') }}
  
  <div class=\"layui-body\">
    <!-- 内容主体区域 -->
    <div style=\"padding: 15px;\">
      {% block body %}{% endblock %}
    </div>
  </div>
  
  <div class=\"layui-footer\">
    <!-- 底部固定区域 -->
    ©zeelis.com 2017-2021
  </div>
</div>
<script src=\"http://lab.io/index.php/staic/layui/layui.js\"></script>
<script>
layui.use('element', function(){var element = layui.element;});
</script>
</body>
</html>", "layout.twig", "D:\\SOFT\\phpstudy_pro\\WWW\\lab\\app\\view\\layout.twig");
    }
}
