<?php

use Controller\ApiController\ApiController;
use Model\ClientModel\ClientModel;
use Pet\Router\Router;

Router::get('/api/{parser}', [ApiController::class, 'updateReviews']);
Router::get('/feedback/{api}/{id}', [ApiController::class, 'feedback']);
Router::put('/feedback/{api}/{id}', [ApiController::class, 'sendClient']);
Router::get('/match', [ApiController::class, 'match']);
Router::get('/paralele', [ApiController::class, 'paralele']);
Router::get('/imap-update', [ApiController::class, 'updateImap']);
Router::get('/callback-parser', [ApiController::class, 'updateReviewsCallback']);

//внешние подключение js widget 
Router::get('/widgets/js', [ApiController::class, 'getJsWigets']);
Router::get('/widgets/css', [ApiController::class, 'getCssWigets']);
Router::get('/widgets/{api}', [ApiController::class, 'getDataWidgets']);
Router::options('/widgets/{api}', [ApiController::class, 'getDataWidgets']);
?>