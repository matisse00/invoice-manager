# invoice-manager
## How to run

### Docker
Building: `docker-compose build`  
Running: `docker-compose up`

###### Remember to add volume if you want keep your DB safe. 

### Local
1. Setup MySQL with .env file
2. `composer install`
3. `npm install`
4. `npm run dev`
5. `php artisan migrate:fresh`
6. `php artisan db:seed`
7. `php artisan serve`

## App

* Go to `localhost:port/` to see list of invoices, 
if you'll click on it you will be able to see details or export invoice to PDF.
* Go to `localhost:port/api/` 
You can find invoices by using  
api/company=_company_id_/invoices  
api/company=_company_id_/invoices/_invoice_id_
