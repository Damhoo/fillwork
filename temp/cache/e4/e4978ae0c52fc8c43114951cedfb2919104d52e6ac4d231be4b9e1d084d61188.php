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

/* index_index.twig */
class __TwigTemplate_be2360d5e6c08e5cdb5fb9f7e2d7017e9d25a4a7dcd357ee5a30234d941b83b4 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "layout.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $this->parent = $this->loadTemplate("layout.twig", "index_index.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_title($context, array $blocks = [])
    {
        echo "后台首页";
    }

    // line 3
    public function block_body($context, array $blocks = [])
    {
        // line 4
        echo "<h1>Hello</h1>
<h1>";
        // line 5
        echo twig_escape_filter($this->env, (isset($context["__APP__"]) ? $context["__APP__"] : null), "html", null, true);
        echo "</h1>
<img src=\"/Index/pie\">
<img src=\"/Index/tel\">
<img src=\"/Index/bar\">
";
    }

    public function getTemplateName()
    {
        return "index_index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  52 => 5,  49 => 4,  46 => 3,  40 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"layout.twig\" %}
{% block title %}后台首页{% endblock %}
{% block body %}
<h1>Hello</h1>
<h1>{{__APP__}}</h1>
<img src=\"/Index/pie\">
<img src=\"/Index/tel\">
<img src=\"/Index/bar\">
{% endblock %}", "index_index.twig", "D:\\SOFT\\phpstudy_pro\\WWW\\lab\\app\\view\\index_index.twig");
    }
}
