<?php namespace App\Http\Controllers;

use Auth;
use Input;
use Utils;
use Response;
use App\Models\Invoice;
use App\Ninja\Repositories\InvoiceRepository;
use App\Http\Controllers\BaseAPIController;
use App\Ninja\Transformers\QuoteTransformer;

class QuoteApiController extends BaseAPIController
{
    protected $invoiceRepo;

    protected $entityType = ENTITY_INVOICE;

    public function __construct(InvoiceRepository $invoiceRepo)
    {
        parent::__construct();

        $this->invoiceRepo = $invoiceRepo;
    }

    /**
     * @SWG\Get(
     *   path="/quotes",
     *   tags={"quote"},
     *   summary="List of quotes",
     *   @SWG\Response(
     *     response=200,
     *     description="A list with quotes",
     *      @SWG\Schema(type="array", @SWG\Items(ref="#/definitions/Invoice"))
     *   ),
     *   @SWG\Response(
     *     response="default",
     *     description="an ""unexpected"" error"
     *   )
     * )
     */
     public function index()
     {
         $invoices = Invoice::scope()
                         ->withTrashed()
                         ->where('is_quote', '=', '1')
                         ->with('invoice_items', 'client')
                         ->orderBy('created_at', 'desc');

         return $this->listResponse($invoices);
     }

}
