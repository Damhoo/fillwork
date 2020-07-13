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

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
<head>
<meta charset=\"utf-8\">
<title>";
        // line 5
        echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
        echo "</title>
</head>
<body>
<style type=\"text/css\">
\ttable,tr,th,td{border-color: #efefef;}
</style>
<h1>Hello</h1>
<img src=\"/Index/pie\">
<img src=\"/Index/tel\">
<img src=\"/Index/bar\">
</body>
</html>";
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
        return array (  36 => 5,  30 => 1,);
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
<title>{{title}}</title>
</head>
<body>
<style type=\"text/css\">
\ttable,tr,th,td{border-color: #efefef;}
</style>
<h1>Hello</h1>
<img src=\"/Index/pie\">
<img src=\"/Index/tel\">
<img src=\"/Index/bar\">
</body>
</html>", "index_index.twig", "D:\\SOFT\\phpstudy_pro\\WWW\\lab\\app\\view\\index_index.twig");
    }
}
