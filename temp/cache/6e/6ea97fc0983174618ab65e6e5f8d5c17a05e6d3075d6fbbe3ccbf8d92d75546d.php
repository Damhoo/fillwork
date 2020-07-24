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

/* api_login.twig */
class __TwigTemplate_cd1e7bbfa52db1b1f792a3b69c05c2df65f07b2e79bd21618ac546a8f92e2b68 extends \Twig\Template
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
<meta charset=\"utf-8\">
<head>
<title>";
        // line 5
        echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
        echo "</title>
</head>
<body>
<div class=\"log\">
\t<form action=\"/api/login\" method=\"POST\">
\t\t<p><label for=\"account\"></label><input type=\"text\" name=\"account\" id=\"account\" /></p>
\t\t<p><label for=\"password\"></label><input type=\"password\" name=\"password\" id=\"password\" /></p>
\t\t<p><input type=\"submit\" value=\"Login\"></p>
\t</form>
</div>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "api_login.twig";
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
<meta charset=\"utf-8\">
<head>
<title>{{title}}</title>
</head>
<body>
<div class=\"log\">
\t<form action=\"/api/login\" method=\"POST\">
\t\t<p><label for=\"account\"></label><input type=\"text\" name=\"account\" id=\"account\" /></p>
\t\t<p><label for=\"password\"></label><input type=\"password\" name=\"password\" id=\"password\" /></p>
\t\t<p><input type=\"submit\" value=\"Login\"></p>
\t</form>
</div>
</body>
</html>", "api_login.twig", "E:\\SITE\\lab\\app\\view\\api_login.twig");
    }
}
