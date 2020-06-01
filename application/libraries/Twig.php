<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFilter;
use Twig\TwigFunction;
use Twig\TwigFunction\DebugExtension;
/**
 * Part of CodeIgniter Simple and Secure Twig
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @link       https://github.com/kenjis/codeigniter-ss-twig
 * @author     darkterminal <https://github.com/darkterminal>
 * @link       https://github.com/darkterminal/twigniter
 * @license    MIT License
 * @copyright  2020 Kenji Suzuki, darkterminal
 */
defined('BASEPATH') OR exit('No direct script access allowed');

// If you don't use Composer, uncomment below

require_once APPPATH . 'helpers/app_filters.php';
require_once FCPATH . 'vendor/autoload.php';


class Twig
{
    /**
     * @var array Paths to Twig templates
     */
    private $paths = [];

    /**
     * @var array Twig Environment Options
     * @see http://twig.sensiolabs.org/doc/api.html#environment-options
     */
    private $config = [];

    /**
     * @var array Functions to add to Twig
     */
    private $functions_asis = [
        'base_url', 'site_url'
    ];

    /**
     * @var array Filter to add to Twig
     */
    private $filters_asis = [
        'abs'
    ];

    /**
     * @var array Functions with `is_safe` option
     * @see http://twig.sensiolabs.org/doc/advanced.html#automatic-escaping
     */
    private $functions_safe = [
        'form_open', 'form_close', 'form_error', 'form_hidden', 'set_value',
         'form_open_multipart', 'form_upload', 'form_submit', 'form_dropdown',
         'set_radio', 'set_select', 'set_checkbox',
    ];

    /**
     * @var bool Whether functions are added or not
     */
    private $functions_added = FALSE;

    /**
     * @var bool Whether filter are added or not
     */
    private $filters_added = FALSE;

    /**
     * @var Twig_Environment
     */
    private $twig;

    /**
     * @var Twig_Loader_Filesystem
     */
    private $loader;

    public function __construct($params = [])
    {
        if (isset($params['functions']))
        {
            $this->functions_asis =
                array_unique(
                    array_merge($this->functions_asis, $params['functions'])
                );
            unset($params['functions']);
        }
        if (isset($params['filters']))
        {
            $this->filters_asis =
                array_unique(
                    array_merge($this->filters_asis, $params['filters'])
                );
            unset($params['filters']);
        }
        if (isset($params['functions_safe']))
        {
            $this->functions_safe =
                array_unique(
                    array_merge($this->functions_safe, $params['functions_safe'])
                );
            unset($params['functions_safe']);
        }

        if (isset($params['paths']))
        {
            $this->paths = $params['paths'];
            unset($params['paths']);
        }
        else
        {
            $this->paths = [VIEWPATH];
        }

        // default Twig config
        $this->config = [
            'cache'      => APPPATH . 'cache/twig',
            'debug'      => ENVIRONMENT !== 'production',
            'autoescape' => 'html',
        ];

        $this->config = array_merge($this->config, $params);
    }

    protected function resetTwig()
    {
        $this->twig = null;
        $this->createTwig();
    }

    protected function createTwig()
    {
        // $this->twig is singleton
        if ($this->twig !== null)
        {
            return;
        }

        if ($this->loader === null)
        {
            $this->loader = new FilesystemLoader($this->paths);
        }

        $twig = new Environment($this->loader, $this->config);

        $this->twig = $twig;
    }

    protected function setLoader($loader)
    {
        $this->loader = $loader;
    }

    /**
     * Registers a Global
     *
     * @param string $name  The global name
     * @param mixed  $value The global value
     */
    public function addGlobal($name, $value)
    {
        $this->createTwig();
        $this->twig->addGlobal($name, $value);
    }

    /**
     * Renders Twig Template and Set Output
     *
     * @param string $view   Template filename without `.twig`
     * @param array  $params Array of parameters to pass to the template
     */
    public function display($view, $params = [])
    {
        $params = array_merge($this->default_parser(), $params);
        $CI =& get_instance();
        $CI->output->set_output($this->render($view, $params));
    }

    /**
     * Renders Twig Template and Returns as String
     *
     * @param string $view   Template filename without `.twig`
     * @param array  $params Array of parameters to pass to the template
     * @return string
     */
    public function render($view, $params = [])
    {
        $this->createTwig();
        // We call addFunctions() here, because we must call addFunctions()
        // after loading CodeIgniter functions in a controller.
        $this->addFunctions();
        $this->addFilters();

        $view = $view . '.twig';
        return $this->twig->render($view, $params);
    }

    protected function addFilters()
    {
        // Runs only once
        if ($this->filters_added)
        {
            return;
        }

        // as is filters
        foreach ($this->filters_asis as $filter)
        {
            if (function_exists($filter))
            {
                $this->twig->addFilter(
                    new TwigFilter($filter)
                );
            }
        }

        $this->filters_added = TRUE;
    }

    protected function addFunctions()
    {
        // Runs only once
        if ($this->functions_added)
        {
            return;
        }

        // as is functions
        foreach ($this->functions_asis as $function)
        {
            if (function_exists($function))
            {
                $this->twig->addFunction(
                    new TwigFunction(
                        $function,
                        $function
                    )
                );
            }
        }

        // safe functions
        foreach ($this->functions_safe as $function)
        {
            if (function_exists($function))
            {
                $this->twig->addFunction(
                    new TwigFunction(
                        $function,
                        $function,
                        ['is_safe' => ['html']]
                    )
                );
            }
        }

        $this->functions_added = TRUE;
    }

    /**
     * @param string $uri
     * @param string $title
     * @param array  $attributes [changed] only array is acceptable
     * @return string
     */
    public function safe_anchor($uri = '', $title = '', $attributes = [])
    {
        $uri = html_escape($uri);
        $title = html_escape($title);

        $new_attr = [];
        foreach ($attributes as $key => $val)
        {
            $new_attr[html_escape($key)] = html_escape($val);
        }

        return anchor($uri, $title, $new_attr);
    }

    /**
     * @return \Twig_Environment
     */
    public function getTwig()
    {
        $this->createTwig();
        return $this->twig;
    }

    public function default_parser()
    {
        return [
            'ENVIRONMENT' => ENVIRONMENT,
            'CI_VERSION' => CI_VERSION
        ];
    }
}
