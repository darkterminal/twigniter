<?php 

/**
 * Betta Controller
 *
 * Core Controller in Twigniter
 *
 * @category   Core Controller
 * @package    Betta_Controller
 * @author     Imam Ali Mustofa <iam@betatdevindonesia.com>
 * @author     Roy Alkina <darkterminal@pm.me>
 * @copyright  2020 Betta Dev Indonesia
 * @license    MIT License
 * @version    Release: v1.0
 * @link       http://bettadevindonesia.com
 */

defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'third_party/get_defined_functions_in_file.php';

class Betta_Controller extends CI_Controller
{
    protected $data;

    public function __construct()
    {

        parent::__construct();
        # Load libraries
        // $this->load->library([]);
        
        # Load Models
        // $this->load->model([]);
        
        # Load helpers
        $this->load->helper(['url','html','app_helper']);

        $defined_functions = get_defined_functions();
        $defined_filters = functions_in_file(APPPATH . 'helpers/app_filters.php');
        # Configure Twig
        $config = [ 
            'debug' => true,
            'cache' => APPPATH . '/cache', 
            'functions' => $defined_functions['user'],
            'functions_safe' => $defined_functions['internal'],
            'filters' => $defined_filters
        ];
        $this->load->library('twig', $config);

        # Define global constanst variable
        $defined_contants = get_defined_constants(true);
        foreach ($defined_contants['user'] as $key => $value) {
            $this->twig->addGlobal($key, $value);
        }

        # Define your own global variable
        $this->twig->addGlobal('elapsed_time', time_execution());
        $this->twig->addGlobal('twig_version', Twig\Environment::VERSION);

    }
}
