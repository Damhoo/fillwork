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

/* sidebar.twig */
class __TwigTemplate_babf9d0882938d7ae097a8707ac21fa79cdb15e78650db20f1bfc0ef4335c235 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<div class=\"layui-side layui-bg-black\">
  <div class=\"layui-side-scroll\">
    <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
    <ul class=\"layui-nav layui-nav-tree\"  lay-filter=\"test\">
      <li class=\"layui-nav-item layui-nav-itemed\">
        <a class=\"\" href=\"javascript:;\">所有商品</a>
        <dl class=\"layui-nav-child\">
          <dd><a href=\"javascript:;\">列表一</a></dd>
          <dd><a href=\"javascript:;\">列表二</a></dd>
          <dd><a href=\"javascript:;\">列表三</a></dd>
          <dd><a href=\"\">超链接</a></dd>
        </dl>
      </li>
      <li class=\"layui-nav-item\">
        <a href=\"javascript:;\">解决方案</a>
        <dl class=\"layui-nav-child\">
          <dd><a href=\"javascript:;\">列表一</a></dd>
          <dd><a href=\"javascript:;\">列表二</a></dd>
          <dd><a href=\"\">超链接</a></dd>
        </dl>
      </li>
      <li class=\"layui-nav-item\"><a href=\"\">云市场</a></li>
      <li class=\"layui-nav-item\"><a href=\"\">发布商品</a></li>
    </ul>
  </div>
</div>";
    }

    public function getTemplateName()
    {
        return "sidebar.twig";
    }

    public function getDebugInfo()
    {
        return array (  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("<div class=\"layui-side layui-bg-black\">
  <div class=\"layui-side-scroll\">
    <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
    <ul class=\"layui-nav layui-nav-tree\"  lay-filter=\"test\">
      <li class=\"layui-nav-item layui-nav-itemed\">
        <a class=\"\" href=\"javascript:;\">所有商品</a>
        <dl class=\"layui-nav-child\">
          <dd><a href=\"javascript:;\">列表一</a></dd>
          <dd><a href=\"javascript:;\">列表二</a></dd>
          <dd><a href=\"javascript:;\">列表三</a></dd>
          <dd><a href=\"\">超链接</a></dd>
        </dl>
      </li>
      <li class=\"layui-nav-item\">
        <a href=\"javascript:;\">解决方案</a>
        <dl class=\"layui-nav-child\">
          <dd><a href=\"javascript:;\">列表一</a></dd>
          <dd><a href=\"javascript:;\">列表二</a></dd>
          <dd><a href=\"\">超链接</a></dd>
        </dl>
      </li>
      <li class=\"layui-nav-item\"><a href=\"\">云市场</a></li>
      <li class=\"layui-nav-item\"><a href=\"\">发布商品</a></li>
    </ul>
  </div>
</div>", "sidebar.twig", "D:\\SOFT\\phpstudy_pro\\WWW\\lab\\app\\view\\sidebar.twig");
    }
}
