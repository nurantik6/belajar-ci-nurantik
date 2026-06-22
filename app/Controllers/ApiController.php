<?php
    namespace App\Controllers;
    
    use CodeIgniter\HTTP\ResponseInterface;
    use CodeIgniter\RESTful\ResourceController;

    use App\Models\UserModel;
    use App\Models\TransactionModel;
    use App\Models\TransactionDetailModel;
    
    class ApiController extends ResourceController
    
    {   protected $apiKey;
        protected $user;
        protected $transaction;
        protected $transaction_detail;

        function __construct()
        {
            $this->apiKey=env('API_KEY');
            $this->user=new UserModel();
            $this->transaction=new TransactionModel();
            $this->transaction_detail=new TransactionDetailModel();
        }
    }