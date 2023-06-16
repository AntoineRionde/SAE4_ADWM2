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

/* articlesByCategories.twig */
class __TwigTemplate_d705204e91ad707be9f5602fe1ca0905 extends Template
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
        $this->parent = $this->loadTemplate("squelette.twig", "articlesByCategories.twig", 1);
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
        if ((twig_length_filter($this->env, ($context["articles"] ?? null)) > 0)) {
            // line 9
            echo "            ";
            $context["sortedArticles"] = twig_sort_filter($this->env, ($context["articles"] ?? null), function ($__a__, $__b__) use ($context, $macros) { $context["a"] = $__a__; $context["b"] = $__b__; return (twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["a"] ?? null), "date_creation", [], "any", false, false, false, 9), "Ymd") <=> twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["b"] ?? null), "date_creation", [], "any", false, false, false, 9), "Ymd")); });
            // line 10
            echo "            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["sortedArticles"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["art"]) {
                // line 11
                echo "                <li>
                    <h2>";
                // line 12
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["art"], "titre", [], "any", false, false, false, 12), "html", null, true);
                echo "</h2>
                    <p>Paru le : ";
                // line 13
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["art"], "date_creation", [], "any", false, false, false, 13), "html", null, true);
                echo "</p>
                </li>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['art'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 16
            echo "        ";
        } else {
            // line 17
            echo "            <li>Aucun article trouvé.</li>
        ";
        }
        // line 19
        echo "    </ul>
";
    }

    public function getTemplateName()
    {
        return "articlesByCategories.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  95 => 19,  91 => 17,  88 => 16,  79 => 13,  75 => 12,  72 => 11,  67 => 10,  64 => 9,  62 => 8,  58 => 6,  54 => 5,  47 => 3,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "articlesByCategories.twig", "C:\\wamp64\\www\\SAE4_ADWM2\\minipress.core\\press.appli\\src\\templates\\articlesByCategories.twig");
    }
}