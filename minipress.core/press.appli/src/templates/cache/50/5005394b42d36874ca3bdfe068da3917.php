<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* templateArticles.twig */
class __TwigTemplate_8b3f0c7ff0042c29db9d4035ea95de6b extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "squelette.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("squelette.twig", "templateArticles.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        echo "Articles";
    }

    // line 5
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 6
        echo "    <h1>Articles</h1>
    <ul>
        ";
        // line 8
        if ((twig_length_filter($this->env, ($context["articles"] ?? null)) > 1)) {
            // line 9
            echo "        <p>";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["articles"] ?? null), "id", [], "any", false, false, false, 9), "html", null, true);
            echo "</p>
            ";
            // line 10
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["articles"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["art"]) {
                // line 11
                echo "                <li>
                    <h2>";
                // line 12
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["art"], "titre", [], "any", false, false, false, 12), "html", null, true);
                echo "</h2><p>paru le : ";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["arti"] ?? null), "date_publication", [], "any", false, false, false, 12), "html", null, true);
                echo "</p>
                </li>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['art'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 15
            echo "        ";
        }
        // line 16
        echo "    </ul>
";
    }

    public function getTemplateName()
    {
        return "templateArticles.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  90 => 16,  87 => 15,  76 => 12,  73 => 11,  69 => 10,  64 => 9,  62 => 8,  58 => 6,  54 => 5,  47 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "templateArticles.twig", "D:\\wamp64\\www\\SAE4_ADWM2\\minipress.core\\press.appli\\src\\templates\\templateArticles.twig");
    }
}