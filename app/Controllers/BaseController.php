<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

//Impor Class Model
use App\Models\UserModel;
use App\Models\KartuModel;
use App\Models\RoleModel;
use App\Models\StatusModel;
use App\Models\TransaksiModel;
use App\Models\JenisTransaksiModel;
use App\Models\StatusTransaksiModel;
use App\Models\HargaModel;
use Config\Services;


/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    protected $userModel = UserModel::class;
    protected $kartuModel = KartuModel::class;
    protected $roleModel = RoleModel::class;
    protected $statusmodel = StatusModel::class;
    protected $transaksiModel = TransaksiModel::class;
    protected $jenistransaksiModel = JenisTransaksiModel::class;
    protected $statustransaksiModel = StatusTransaksiModel::class;
    protected $hargaModel = HargaModel::class;
    protected $pager;
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        $this->userModel = new UserModel();
        $this->kartuModel = new KartuModel();
        $this->roleModel = new RoleModel();
        $this->transaksiModel = new TransaksiModel();
        $this->jenistransaksiModel = new JenisTransaksiModel();
        $this->statustransaksiModel = new StatusTransaksiModel();
        $this->hargaModel = new HargaModel();
        $this->statusmodel = new StatusModel();
        $this->pager = Services::pager();
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();

        // Preload any models
        // E.g.: $this->session = new session();

    }
}
