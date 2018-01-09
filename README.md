# E-conomicPHPWrapper
PHP Wrapper for E-conomic REST API implementing a fluent interface pattern

The Wrapper is made to be used with a E-conomic developer agreement where a end user can connect their agreement to your system through a token. Please tak a look at the connection guide to understand the mechanism behind obtaining the tokens at https://www.e-conomic.com/developer/connect

This E-conomic PHP Wrapper supports following options:
1. Customers - Create, Show, Update, Delete & Filter by filterable options.
2. Currency - Get all & Get one by currency code fx. "DKK".
3. Units - Create, Show, Update, Delete.
4. Products - Create, Show, Update, Delete.
5. Payment types - Get all & Get one by ID.
6. Layouts - Get all & Get one by ID.
7. Invoice(draft) - Create with empty invoicelines, create with invoicelines where products are assigned & You can book invoice.

## 1. Getting Started

In order to work with this E-conomic wrapper you'll need to provide a AppSecretToken & AgreementGrantToken key. The AppSecretToken is the one you obtain from your E-conomic developer account and the AgreementGrantToken is obtained from the customer. See Step 2A for manual or 2B for automatic retrival of the token at https://www.e-conomic.com/developer/connect

Be sure to set the correct namespace of the E-conomic wrapper.

```
$economic = new Economic(
    'AppSecretToken key',
    'AgreementGrantToken key'
); 
```



### 2. Customers 

There are two different customer objects, they are listed below.

* **Customer**
* **CustomerCollection**
    
    #### 2.1. Customer
    **Read** - You can retrieve customers one by one with this object, aswell this object is the one you use when you wan't to create,       update & delete a specific customer.
    
    ```
    $customer = $economic
                ->customer()
                ->get('ID'); // This will give you all information about this customer.
    ```
    
    **Create** - If you wan't to create a customer there are five properties that are required before you can do that, they are *name,       currency, paymentTerms, customerGroup, vatZone*. 
    
    ```
    $customer = $economic
                ->customer()
                ->setCurrency('DKK') // You can retrive one list with all available currencies.
                ->setName('Test Company')
                ->setPaymentTermsNumber(1)
                ->setCustomerGroupNumber(1)
                ->setVatZoneNumber(1)
                ->create();
                ->getCustomerNumber(); After you have created this customer you can retrieve its ID by doing this.
    ```
    
    **Update** - To update a customer the process is almost identical, however you are not required to provide any properties, you can       simply choose to update any property.
    
    ```
    $customer = $economic
                ->customer()
                ->get('ID') // Retrieve existing customer
                ->setName('Test Company')
                ->setCustomerGroupNumber(2)
                ->setVatZoneNumber(1)
                ->update(); // Updates customer.
    ```
    
    **Delete** - You can delete any customer, with a simple method.
    
    ```
    $customer = $economic
                ->customer()
                ->get('ID')
                ->delete(); // Deletes customer.
    ```
    
    #### 2.2. CustomerCollection
    **Read** - This will give you an entire list of all customers, another option there is, is that you can filter on customer names.
    
    ```
    $customer = $economic
                ->customerCollection()
                ->all();
    ```
    
    **Filter** - Filter on filterable properties, incase something match it will return object with information about the given             customer, make sure to read through the documentation in order to see which properties you can filter on, I do also recommend read       through the Filter documentation to see which operators they support.  
    
    Filterable properties: [https://restdocs.e-conomic.com/#customers](https://restdocs.e-conomic.com/#customers)
    
    Filter operators: [https://restdocs.e-conomic.com/#filtering](https://restdocs.e-conomic.com/#filtering) 
    
    ```
    $customer = $economic
                ->customerCollection()
                ->all(new Filter(['name'], ['$like:'], ['Mikkel'])); // Bear in mind you can filter on more properties, you simply add                                                                           them to the array.
    ```
